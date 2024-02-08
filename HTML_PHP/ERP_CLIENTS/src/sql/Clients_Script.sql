CREATE DATABASE db_Clients_Prog;

USE db_Clients_Prog;

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30),
    last_name VARCHAR(50),
    company_name VARCHAR(50),
    address VARCHAR(100),
    city VARCHAR(30),
    county VARCHAR(100),
    state VARCHAR(50),
    zip INT,
    phone1 VARCHAR(15),
    phone2 VARCHAR(15),
    email VARCHAR(50),
    web VARCHAR(100),
    login VARCHAR(50),
    password VARCHAR(100)
);

INSERT INTO clients (first_name, last_name, company_name, address, city, county, state, zip, phone1, phone2, email, web, login, password)
VALUES
    (@FirstName, @LastName, @Companyname, @Address, @City, @County, @State, @Zip, @Phone1, @Phone2, @Email, @Web, @Login, @Password)