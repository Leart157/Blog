CREATE DATABASE IF NOT EXISTS blog;
USE blog;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(255),
    content TEXT,
    file_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'approved', 'disapproved') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$J9.8uB7W6zT5Y2V1X0sZzOcQd3Ei4rN7HjKlMnbCX1o...', 'admin'),
('guest', '$2y$10$abcdefghiABCDEFGHI1234567890JKLMNOPQRSTUV', 'user');

INSERT INTO posts (user_id, title, content) VALUES
(2, 'Why I Love Coding', 'Sometimes it feels like you can create anything. That''s the magic of code.'),
(2, 'Favorite Places to Visit', 'I love mountains, quiet villages, and hidden lakes.'),
(2, 'How I Started Blogging', 'It all started with a simple PHP file and a dream.');