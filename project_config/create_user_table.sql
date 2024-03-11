use ldf_dev_db;
CREATE TABLE users
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(30)  NOT NULL,
    password VARCHAR(128) NOT NULL,
    email VARCHAR(30),
    phone int ,
    country VARCHAR(30)
);
