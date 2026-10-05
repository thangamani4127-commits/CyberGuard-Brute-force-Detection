CREATE DATABASE IF NOT EXISTS cyberguard;

USE cyberguard;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    failed_attempts INT DEFAULT 0,
    blocked_until DATETIME NULL
);

INSERT INTO users (username, password)
VALUES ('admin', SHA2('admin123', 256));
