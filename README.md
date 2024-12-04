<div align="center">

# Datum: Data Management App


🎉 Welcome to Datum!

    This is a user-friendly data management application designed to efficiently manage student records.
    The app uses MySQL as its database to store and manage all the data, making it easy for you to work with and retrieve student information whenever needed.
    Data

📧 Email for communicating any issues:

    mugishachrspin590@gmail.com

Database: MySQL
Follow these steps to set up and interact with the database:
1. Create a Database
🔑 Log in to MySQL:

Open your terminal/command prompt and run the following command to access MySQL:

    mysql -u root -p

🏗️ Create a New Database:

After logging in, create the students database by running:

    CREATE DATABASE students;

2. Import the Students Table
📥 Import the students.sql File:

Use the mysql command to import the students.sql file into your newly created database. Here's the command:

    mysql -u root students < path/to/students.sql

This command will load the student data into the students database.
3. Access the Database
🔑 Log in to MySQL Again:

After importing the data, log back into MySQL:

    mysql -u root -p

🔍 Check the Imported Data:

Use the following commands to ensure the students table is successfully imported:

    USE students;
    SHOW TABLES;

If everything is set up correctly, you should see the students table listed!
Enjoy managing your student data! 🎓

If you encounter any issues, feel free to reach out via mugishachrspin590@gmail.com.

# Happy codding
</div>