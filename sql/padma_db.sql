CREATE DATABASE IF NOT EXISTS padma_db;
USE padma_db;

CREATE TABLE menu (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  category VARCHAR(50),
  description TEXT,
  price INT,
  image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(100),
  phone VARCHAR(30),
  type ENUM('takeaway','dinein'),
  total_price INT,
  queue_number INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT,
  menu_id INT,
  quantity INT,
  price INT,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (menu_id) REFERENCES menu(id) ON DELETE CASCADE
);

CREATE TABLE admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(150) UNIQUE,
  password VARCHAR(255),
  name VARCHAR(100)
);

INSERT INTO menu(name, category, description, price, image) VALUES
('Espresso','Kopi','Single shot espresso',15000,'espresso.jpg'),
('Cappuccino','Kopi','Espresso + steamed milk',22000,'cappuccino.jpg');