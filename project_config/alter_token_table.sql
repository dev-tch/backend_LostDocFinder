use ldf_dev_db;
ALTER TABLE personal_access_tokens 
ADD COLUMN last_used_at TIMESTAMP NULL DEFAULT NULL;
