# GroupProject
SJSU CMPE131 Group4

<h3> Database Setting </h3>
<p>DB name: onlineatm</p>
<p>table name: accounts</p>
<p>column:</p>
- email: Unique (since it is our ID) <br>
- password <br>
- firstname <br>
- lastname <br>
- phone <br>
- ssn <br>
- balance: INT <br>

<h3>Creating DB through SQL</h3>
<p>CREATE DATABASE onlineatm</p>
<p>CREATE TABLE MyGuests (
email VARCHAR(255) NOT NULL  PRIMARY KEY,
password VARCHAR(255) NOT NULL,
firstname VARCHAR(255) NOT NULL,
lastname VARCHAR(255) NOT NULL,
phone VARCHAR(255) NOT NULL,
ssn VARCHAR(255) NOT NULL
)</p>

<p>Inserting data</p>
<p>INSERT INTO table_name (column1, column2, column3,...) VALUES (value1, value2, value3,...)</p>
