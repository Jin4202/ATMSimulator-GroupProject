# GroupProject
SJSU CMPE131 Group4

### Database Setting
DB name: onlineatm\
table name: accounts\
column:
* email: Unique (since it is our ID)
* password
* firstname
* lastname
* phone
* ssn
* balance: INT

###Creating DB through SQL
CREATE DATABASE onlineatm\
CREATE TABLE MyGuests (\
email VARCHAR(255) NOT NULL  PRIMARY KEY,\
password VARCHAR(255) NOT NULL,\
firstname VARCHAR(255) NOT NULL,\
lastname VARCHAR(255) NOT NULL,\
phone VARCHAR(255) NOT NULL,\
ssn VARCHAR(255) NOT NULL\
)

###Inserting data
INSERT INTO table_name (column1, column2, column3,...) VALUES (value1, value2, value3,...)\
