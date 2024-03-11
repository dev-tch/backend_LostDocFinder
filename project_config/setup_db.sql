-- create database and user for dev
CREATE DATABASE IF NOT EXISTS ldf_dev_db;
CREATE USER IF NOT EXISTS 'ldf_dev'@'localhost' IDENTIFIED BY 'ldf_dev_pwd';
GRANT ALL PRIVILEGES ON `ldf_dev_db`.* TO 'ldf_dev'@'localhost';
GRANT SELECT ON `performance_schema`.* TO 'ldf_dev'@'localhost';
FLUSH PRIVILEGES;
