CREATE TABLE orders
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_brand VARCHAR(100) NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    product_price INT NOT NULL,
    user_id INT NOT NULL,
    quantity INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products (id)
);

TRUNCATE orders;