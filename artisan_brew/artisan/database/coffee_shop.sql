CREATE DATABASE IF NOT EXISTS artisan_brew CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE artisan_brew;
CREATE TABLE IF NOT EXISTS users(user_id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(120) NOT NULL,email VARCHAR(160) UNIQUE NOT NULL,password VARCHAR(255) NOT NULL,role ENUM('customer','admin') DEFAULT 'customer',created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS products(product_id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(150) NOT NULL,category VARCHAR(80) NOT NULL,price DECIMAL(10,2) NOT NULL,description TEXT NOT NULL,image VARCHAR(180) NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS orders(order_id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,total_amount DECIMAL(10,2) NOT NULL,status VARCHAR(30) DEFAULT 'Pending',payment_method VARCHAR(60) NOT NULL,address TEXT NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(user_id));
CREATE TABLE IF NOT EXISTS order_items(order_item_id INT AUTO_INCREMENT PRIMARY KEY,order_id INT NOT NULL,product_id INT NOT NULL,quantity INT NOT NULL,unit_price DECIMAL(10,2) NOT NULL,FOREIGN KEY(order_id) REFERENCES orders(order_id) ON DELETE CASCADE,FOREIGN KEY(product_id) REFERENCES products(product_id));
CREATE TABLE IF NOT EXISTS contacts(contact_id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(120) NOT NULL,email VARCHAR(160) NOT NULL,message TEXT NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
INSERT INTO products(name,category,price,description,image) VALUES
('Espresso Dark Blend','Dark Roast',19.00,'Bold, full-bodied with smoky undertones and an intense cocoa finish.','espresso-dark.svg'),
('Morning Caramel Blend','Medium Roast',16.00,'Sweet and buttery with smooth caramel notes and a clean finish.','morning-caramel.svg'),
('Swiss Water Decaf','Decaf',18.00,'Rich, mellow, and comforting with a clean finish.','swiss-decaf.svg'),
('Ethiopian Yirgacheffe','Medium Roast',18.00,'Floral, citrusy and bright with a clean finish.','morning-caramel.svg'),
('Colombian Supremo','Medium Roast',17.00,'Balanced, nutty and sweet with a smooth body.','espresso-dark.svg');
-- After registering, promote your account:
-- UPDATE users SET role='admin' WHERE email='your-email@example.com';
