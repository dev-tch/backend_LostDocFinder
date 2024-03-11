-- create table document with link to user 

use ldf_dev_db;
CREATE TABLE IF NOT EXISTS documents 
(
    doc_id          VARCHAR(30) PRIMARY KEY NOT NULL,
    doc_type        VARCHAR(30)  NOT NULL,
    doc_description VARCHAR(200) NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

