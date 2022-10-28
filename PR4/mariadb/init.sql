CREATE DATABASE IF NOT EXISTS appDB;
ALTER DATABASE appDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT,DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
SET NAMES UTF8;

CREATE TABLE IF NOT EXISTS toy (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,
    description TEXT,
    price INT NOT NULL,
    count INT NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO toy (name, price, count)
VALUES  ('пистолетик', 1200, 120),
        ('кукла', 1000, 432),
        ('игрушечный компьютер', 5400, 32);

CREATE TABLE IF NOT EXISTS purchase (
   id INT NOT NULL AUTO_INCREMENT,
   name VARCHAR(64) NOT NULL,
   toy_id INT NOT NULL,
   FOREIGN KEY (toy_id) REFERENCES toy(id),
   wholesale_price INT NOT NULL,
   count INT NOT NULL,
   PRIMARY KEY (ID)
);

INSERT INTO purchase (name, toy_id, wholesale_price, count)
VALUES ('закупка №43', 1, 110, 100),
       ('закупка №44', 2, 400, 10);

CREATE TABLE IF NOT EXISTS user (
    id INT(11) NOT NULL AUTO_INCREMENT,
    login VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(33) NOT NULL,
    PRIMARY KEY(id)
);

INSERT INTO user (login, password)
VALUES ('admin', '{SHA}0DPiKuNIrrVmD8IUCuw1hQxNqZc=');