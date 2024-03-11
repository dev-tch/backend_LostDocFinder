use ldf_dev_db;
CREATE TABLE `personal_access_tokens` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `tokenable_id` INT UNSIGNED NOT NULL,
    `tokenable_type` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `token` TEXT NOT NULL,
    `abilities` TEXT NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    `expires_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
