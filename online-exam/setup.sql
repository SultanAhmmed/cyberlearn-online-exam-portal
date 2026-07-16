-- Create database and user
CREATE DATABASE sqli;
USE sqli;

CREATE USER IF NOT EXISTS 'sultan'@'localhost' IDENTIFIED BY 'sultan123';
GRANT ALL PRIVILEGES ON sqli.* TO 'sultan'@'localhost';
FLUSH PRIVILEGES;

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    role ENUM('admin','student') DEFAULT 'student'
);

-- Demo users
INSERT INTO users (username, password, email, role) VALUES
('admin', 'admin123', 'admin@exam.com', 'admin'),
('alice', 'alice123', 'alice@example.com', 'student'),
('bob', 'bob123', 'bob@example.com', 'student'),
('charlie', 'charlie123', 'charlie@example.com', 'student'),
('diana', 'diana123', 'diana@example.com', 'student');

-- Exams table
CREATE TABLE exams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    description TEXT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO exams (title, description, created_by) VALUES
('Midterm Math', 'Chapters 1-5, multiple choice.', 1),
('Physics Final', 'Covers mechanics and thermodynamics.', 1),
('Chemistry Quiz', 'Periodic table and reactions.', 1);

-- Comments table (for discussion)
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    comment TEXT,
    posted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO comments (user_id, comment) VALUES
(2, 'Good luck everyone!'),
(3, 'The midterm was fair.');

-- Grades table
CREATE TABLE grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    subject VARCHAR(100),
    grade INT,
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Sample grades for students
INSERT INTO grades (student_id, subject, grade) VALUES
(2, 'Mathematics', 85),
(2, 'Physics', 72),
(2, 'Chemistry', 90),
(3, 'Mathematics', 65),
(3, 'Physics', 78),
(3, 'Chemistry', 60),
(4, 'Mathematics', 95),
(4, 'Physics', 88),
(4, 'Chemistry', 92),
(5, 'Mathematics', 70),
(5, 'Physics', 65),
(5, 'Chemistry', 75);