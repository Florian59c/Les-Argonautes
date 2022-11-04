CREATE DATABASE mythologie;

USE mythologie;

CREATE TABLE Argonaute(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL
);

INSERT INTO Argonaute
(name)
VALUES
('Eleftheria'),
('Gennadios'),
('Lysimachos');