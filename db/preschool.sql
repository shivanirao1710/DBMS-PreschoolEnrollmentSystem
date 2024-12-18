-- Create Database
CREATE DATABASE preschool;

USE preschool;

-- Students Table
CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    dob DATE NOT NULL,
    parent_name VARCHAR(100) NOT NULL,
    contact_number VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL
);

-- Teachers Table
CREATE TABLE teachers (
    teacher_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    hire_date DATE NOT NULL,
    contact_number VARCHAR(15) NOT NULL
);

-- Courses Table (Preschool Activities)
CREATE TABLE courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    duration VARCHAR(50) NOT NULL
);

-- Enrollment Table (For enrolling students in courses)
CREATE TABLE enrollment (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    enrollment_date DATE NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
);

-- Payments Table (Tracking payments for student enrollment)
CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    payment_date DATE NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(student_id)
);

-- Insert Sample Data into Students Table
INSERT INTO students (first_name, last_name, dob, parent_name, contact_number, address) VALUES
('John', 'Doe', '2019-03-15', 'Mr. Doe', '1234567890', '123 Elm St, City'),
('Jane', 'Smith', '2018-04-20', 'Ms. Smith', '1234567891', '456 Oak St, City'),
('Jim', 'Brown', '2019-05-25', 'Mr. Brown', '1234567892', '789 Pine St, City'),
('Jack', 'Johnson', '2018-06-30', 'Mrs. Johnson', '1234567893', '321 Birch St, City'),
('Jill', 'Taylor', '2019-07-10', 'Mr. Taylor', '1234567894', '654 Cedar St, City');

-- Insert Sample Data into Teachers Table
INSERT INTO teachers (first_name, last_name, subject, hire_date, contact_number) VALUES
('Mr.', 'Williams', 'Math', '2015-08-01', '9876543210'),
('Ms.', 'Jones', 'Science', '2016-09-01', '9876543211'),
('Mr.', 'Miller', 'English', '2017-10-01', '9876543212'),
('Ms.', 'Davis', 'History', '2018-11-01', '9876543213'),
('Mr.', 'Garcia', 'Art', '2019-12-01', '9876543214');

-- Insert Sample Data into Courses Table
INSERT INTO courses (course_name, description, duration) VALUES
('Math Play', 'Basic math concepts with fun activities.', '6 months'),
('Science Fun', 'Exploring the world of science with hands-on activities.', '5 months'),
('English Play', 'Learning English through songs and stories.', '6 months'),
('History Fun', 'Introduction to historical events in a playful way.', '5 months'),
('Art & Craft', 'Creative art projects to encourage imagination.', '4 months');

-- Insert Sample Data into Enrollment Table
INSERT INTO enrollment (student_id, course_id, enrollment_date) VALUES
(1, 1, '2023-09-01'),
(2, 2, '2023-09-05'),
(3, 3, '2023-09-10'),
(4, 4, '2023-09-12'),
(5, 5, '2023-09-15');

-- Insert Sample Data into Payments Table
INSERT INTO payments (student_id, payment_date, amount) VALUES
(1, '2023-09-05', 100.00),
(2, '2023-09-06', 120.00),
(3, '2023-09-08', 110.00),
(4, '2023-09-10', 130.00),
(5, '2023-09-12', 115.00);

-- Trigger to automatically add a payment when a student enrolls
DELIMITER //
CREATE TRIGGER after_enrollment_insert
AFTER INSERT ON enrollment
FOR EACH ROW
BEGIN
    INSERT INTO payments (student_id, payment_date, amount)
    VALUES (NEW.student_id, NOW(), 100.00);
END; //
DELIMITER ;


