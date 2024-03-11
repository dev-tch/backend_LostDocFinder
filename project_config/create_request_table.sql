-- table to save requests doc_lost && doc_found
use ldf_dev_db;
CREATE TABLE IF NOT EXISTS document_requests
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    doc_id          VARCHAR(30)  NOT NULL,
    doc_type        VARCHAR(30)  NOT NULL,
    req_type        VARCHAR(30)  NOT NULL,
    req_description VARCHAR(200) ,
    req_status      VARCHAR(30) NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
