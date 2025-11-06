CREATE TABLE IF NOT EXISTS posts (
    id int AUTO_INCREMENT PRIMARY KEY,
    title varchar(255) NOT NULL,
    content text NOT NULL,
    published_at timestamp DEFAULT CURRENT_TIMESTAMP,
    user_id int NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;