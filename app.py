from flask import Flask, request, jsonify, session, redirect
import os
import mysql.connector
import openpyxl
import requests

app = Flask(__name__)
app.secret_key = 'your_secret_key'  # Set a secret key for session management

DATA_QUERY_URL = "http://localhost:5000/upload"  # URL of the data_query Flask app

# Database configuration
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',  # Enter your MySQL password here
    'database': 'enmasse',
}

def execute_sql_file(filename, cursor):
    with open(filename, 'r') as file:
        sql = file.read()
    for result in cursor.execute(sql, multi=True):
        pass

def create_unique_table_name(username, cursor):
    suffix = 1
    base_table_name = f"{username}_data"
    table_name = base_table_name

    cursor.execute("SHOW TABLES")
    existing_tables = cursor.fetchall()
    existing_table_names = [table[0] for table in existing_tables]

    while table_name in existing_table_names:
        table_name = f"{base_table_name}_{suffix}"
        suffix += 1

    return table_name

@app.route('/login', methods=['POST'])
def login():
    login_id = request.form['login']
    password = request.form['password']

    try:
        db = mysql.connector.connect(**db_config)
        cursor = db.cursor(dictionary=True)

        execute_sql_file('user_data.sql', cursor)
        
        query = "SELECT * FROM login WHERE username = %s OR email = %s"
        cursor.execute(query, (login_id, login_id))
        user = cursor.fetchone()

        if user and 'password' in user and user['password'] == password:
            session['username'] = user['username']
            response = {"message": "Login successful", "user": user}
        else:
            response = {"message": "Invalid username/email or password"}
        
        cursor.close()
        db.close()
    except mysql.connector.Error as err:
        response = {"message": "An error occurred", "error": str(err)}

    return jsonify(response)

@app.route('/landing_page', methods=['GET', 'POST'])
def landing_page():
    if 'username' not in session:
        return redirect("/login")

    if request.method == 'GET':
        return """
        <!DOCTYPE html>
        <html>
        <head>
            <title>Welcome and Upload Excel File</title>
        </head>
        <body>
            <h2>Welcome, """ + session['username'] + """</h2>
            <p>This is the landing page. You are logged in.</p>
            <p><a href="/logout">Logout</a></p>

            <hr>

            <h2>Upload Excel File</h2>
            <form action="/landing_page" method="post" enctype="multipart/form-data">
                <label for="file">Upload Excel File:</label>
                <input type="file" name="file" id="file" accept=".xlsx">
                <input type="submit" value="Upload">
            </form>
        </body>
        </html>
        """
    else:
        file = request.files['file']
        if file.filename == '':
            return jsonify({"message": "No selected file"}), 400

        if file:
            try:
                # Prepare data to send to data_query Flask app
                files = {'file': (file.filename, file.stream, file.content_type)}
                data = {'username': session['username']}
                
                # Send the file and data to data_query Flask app
                response = requests.post(DATA_QUERY_URL, files=files, data=data)
                if response.status_code == 200:
                    return jsonify({"message": "File uploaded and processed successfully"}), 200
                else:
                    return jsonify({"message": "Error processing the file"}), response.status_code
            except Exception as e:
                return jsonify({"message": "Error processing the file", "error": str(e)}), 500

@app.route('/logout', methods=['GET'])
def logout():
    session.pop('username', None)
    return redirect("/login")

@app.route('/upload', methods=['POST'])
def upload_file():
    if 'username' not in request.form:
        return jsonify({"message": "Username not provided"}), 400

    username = request.form['username']

    if 'file' not in request.files:
        return jsonify({"message": "No file part"}), 400

    file = request.files['file']
    if file.filename == '':
        return jsonify({"message": "No selected file"}), 400

    if file:
        try:
            db = mysql.connector.connect(**db_config)
            cursor = db.cursor()

            workbook = openpyxl.load_workbook(file)
            sheet = workbook.active

            data = []
            for row in sheet.iter_rows(values_only=True):
                data.append(row)

            table_name = create_unique_table_name(username, cursor)

            cursor.execute(f"""
            CREATE TABLE {table_name} (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL
            )
            """)

            for row in data:
                if len(row) >= 2:
                    name, email = row[0], row[1]
                    cursor.execute(f"INSERT INTO {table_name} (name, email) VALUES (%s, %s)", (name, email))

            db.commit()
            cursor.close()
            db.close()

            return jsonify({"message": "File uploaded and processed successfully"}), 200
        except Exception as e:
            return jsonify({"message": "Error processing the file", "error": str(e)}), 500

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
