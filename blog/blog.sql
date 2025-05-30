CREATE DATABASE IF NOT EXISTS blog;
USE blog;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(255),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO users (username, password) VALUES 
('guest', '$2y$10$abcdefghijklmnopqrstuv');

INSERT INTO posts (user_id, title, content) VALUES
(1, 'Why I Love Coding', 'Sometimes it feels like you can create anything. That''s the magic of code.'),
(1, 'Favorite Places to Visit', 'I love mountains, quiet villages, and hidden lakes.'),
(1, 'How I Started Blogging', 'It all started with a simple PHP file and a dream.');