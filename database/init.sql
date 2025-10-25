CREATE DATABASE IF NOT EXISTS waf_test;
USE waf_test;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT
);

INSERT INTO users (username, password, email) VALUES 
('admin', 'admin123', 'admin@example.com'),
('user1', 'password1', 'user1@example.com'),
('test', 'test123', 'test@example.com');

INSERT INTO products (name, price, description) VALUES 
('Laptop', 1500.00, 'High performance laptop'),
('Mouse', 25.50, 'Wireless mouse'),
('Keyboard', 75.00, 'Mechanical keyboard'),
('Monitor', 300.00, '27 inch monitor');
