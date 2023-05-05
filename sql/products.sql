-- Name: Jato Ulrich Guiffo Kengne 
-- Date: April 08, 2023 
-- Section: CST 8285 section 303
-- Assignment: 02 
-- File: products.sql
-- Assignment objective: Use HTML, CSS, JavaScript, PHP and 
-- MySQL to buils a web aplication to perform CRUD operation
--

-- Database: products and php web application user
DROP DATABASE IF EXISTS store;
CREATE DATABASE store;
GRANT USAGE ON *.* TO 'appuser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON store.* TO 'appuser'@'localhost';
FLUSH PRIVILEGES;

USE store;
--
-- Table structure for table products
--
DROP TABLE IF EXISTS products;
CREATE TABLE IF NOT EXISTS products (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  category varchar(255) NOT NULL,
  price int(10) NOT NULL,
  image varchar(255) NOT NULL,
  exp_date date NOT NULL,
  
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table products
--

INSERT INTO products (id, name, category, price, image) VALUES
(1, 'Pineaple', 'Fruits', 20, '6434af1a78f046.27139407.jpg', '2023-04-12'),
(2, 'ASUS TUF F15', 'Computer', 1500, '6434af64745420.05347644.jpg', '2026-04-10');


