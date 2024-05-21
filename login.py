from flask import Flask, request, jsonify
import mysql.connector

app = Flask(__name__)

def execute_sql_file(filename, cursor):
    with open(filename, 'r') as file:
        sql = file.read()
    for result in cursor.execute(sql, multi=True):
        pass

@app.route('/login', methods=['POST'])
def login():
    login_id = request.form['login']
    password = request.form['password']

    try:
        # Connect to MySQL database
        db = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",  # Enter your MySQL password here
            database="enmasse"
        )

        cursor = db.cursor(dictionary=True)

        # Execute user_data.sql if necessary (this could be optimized based on your needs)
        # execute_sql_file('user_data.sql', cursor)  # Uncomment if needed for testing

        # Query database for user
        query = "SELECT * FROM login WHERE username = %s OR email = %s"
        cursor.execute(query, (login_id, login_id))
        user = cursor.fetchone()

        # Check if user exists and password is correct
        if user and user.get('password') == password:
            response = {"message": "Login successful", "user": {"username": user['username'], "email": user['email']}}
        else:
            response = {"message": "Invalid username/email or password"}

        cursor.close()
        db.close()
    except mysql.connector.Error as err:
        response = {"message": "An error occurred", "error": str(err)}

    return jsonify(response)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
