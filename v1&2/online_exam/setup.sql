-- Create user and database
-- CREATE USER 'sultan'@'localhost' IDENTIFIED BY 'sultan123';
CREATE DATABASE sqli;
USE sqli;

-- Table for admin login (string injection)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50)
);

INSERT INTO users (username, password) VALUES
('admin', 'admin123'),
('test', 'test123');

-- Table for students (integer injection)
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    course VARCHAR(50)
);

INSERT INTO students (name, email, course) VALUES
('Alice Johnson', 'alice@example.com', 'Math'),
('Bob Smith', 'bob@example.com', 'Physics'),
('Charlie Brown', 'charlie@example.com', 'Chemistry');

-- Table for exams and comments (stored XSS)
CREATE TABLE exams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    date DATE
);

INSERT INTO exams (title, date) VALUES
('Midterm Exam', '2026-01-15'),
('Final Exam', '2026-06-20');

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    exam_id INT,
    comment TEXT,
    posted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (exam_id) REFERENCES exams(id)
);

-- Insert a harmless comment (no XSS yet)
INSERT INTO comments (exam_id, comment) VALUES
(1, 'Good exam, fair questions.'),
(2, 'Tough but manageable.');

-- Grant privileges
GRANT ALL PRIVILEGES ON sqli.* TO 'sultan'@'localhost';
FLUSH PRIVILEGES;
