from flask import Flask, request, jsonify
import mysql.connector
import json
import openpyxl

app = Flask(__name__)

# Database configuration
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',  # Enter your MySQL password here
    'database': 'enmasse',
}

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
    app.run(host='0.0.0.0', port=5001, debug=True)
