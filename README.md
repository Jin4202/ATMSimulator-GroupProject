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
* saving

### Creating DB through SQL
CREATE DATABASE onlineatm\
CREATE TABLE accounts (\
email VARCHAR(255) NOT NULL  PRIMARY KEY,\
password VARCHAR(255) NOT NULL,\
firstname VARCHAR(255) NOT NULL,\
lastname VARCHAR(255) NOT NULL,\
phone VARCHAR(255) NOT NULL,\
ssn VARCHAR(255) NOT NULL,\
saving TINYINT(1) \
)
