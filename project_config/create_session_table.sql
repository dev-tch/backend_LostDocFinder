-- create session table 
use ldf_dev_db;
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) NOT NULL UNIQUE,
    payload TEXT NOT NULL,
    last_activity INT NOT NULL,
    user_id INT UNSIGNED,
    ip_address VARCHAR(45),
    user_agent TEXT,
    PRIMARY KEY (id)
);
