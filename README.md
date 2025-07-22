# Ebookstore

Ebookstore is a web-based e-commerce platform for purchasing eBooks, featuring user and admin functionalities. Users can browse eBooks, add them to a cart, and make purchases, while admins can manage user data, contact inquiries, and book prices. The project is built with PHP, MySQL, HTML, CSS, and JavaScript, and is designed to run on a WAMP server.

## Features
- **User Features**:
  - Browse and add eBooks to a cart (`cart.html`).
  - View cart with dynamic subtotal, tax, and total calculations.
  - Purchase eBooks with a confirmation alert.
  - Signup and login functionality (`signupform.php`).
  - Contact form for inquiries (`contact.php`).
  - About page with team information (`about.html`).
- **Admin Features**:
  - Secure admin login (`admin_login.php`).
  - Admin dashboard (`admin_dashboard.php`) to:
    - Manage user data (`display_data.php`).
    - Manage contact inquiries (`display_contactdata.php`).
    - Update book prices (`update_prices.php`).
  - Search, delete, and print contact data.
- **Responsive Design**: Mobile-friendly UI with Poppins font and a gradient theme (`#ff523b` buttons).

## Technologies
- **Backend**: PHP 5.x, MySQL
- **Frontend**: HTML, CSS, JavaScript, jQuery 1.12.4, Font Awesome 4.7.0/5.15.4
- **Fonts**: Poppins (Google Fonts)
- **Server**: WAMP (Windows, Apache, MySQL, PHP)
- **External Libraries**:
  - Font Awesome for icons
  - jQuery for interactive elements

## project Path:
Project Path: C:\wamp\www\my project\ebook project\.

## Project Structure
ebook-project/ 
├── images/ │ ├── EbookStore-Logo.png │ ├── cart.png │ ├── menu.png │ ├── favicon.png │ ├── user.png 
    │ ├──  Playstore.  png │ ├── Applestore.png │ ├── EbookStore-Logo-footer.png
├── index.html
├── about.html
├── ebooks.php
├── cart.html 
├── contact.php
├── signupform.php
├── update_form.php
├── login.php
├── admin_login.php 
├── admin_dashboard.php 
├── display_data.php 
├── display_contactdata.php 
├── update_prices.php 
├── logout.php 
├── connection.php  
├── book-detail1.php
├── book-detail2.php
├── book-detail3.php
├── book-detail4.php
├── book-detail5.php
├── book-detail6.php
├── book-detail7.php
├── book-detail8.php
├── book-detail9.php
├── book-detail10.php
├── book-detail11.php
├── book-detail12.php
├── style.css 

├── README.md

## Prerequisites
- WAMP Server (Apache, MySQL, PHP 5.x)
- Web browser (e.g., Chrome, Firefox)
- Text editor (e.g., VS Code)
- Git (for cloning/uploading to GitHub)

## Setup Instructions
1. **Install WAMP**:
   - Download and install WAMP from [wampserver.com](http://www.wampserver.com/).
   - Start WAMP and ensure Apache and MySQL services are running.

2.**Set Up Project**:
Copy the ebook-project folder to C:\wamp\www\my project\ebook project\.
Ensure images/ contains all required assets (EbookStore-Logo.png, cart.png, team3.png, etc.).

3.**Configure Database**:
Open phpMyAdmin (http://localhost/phpmyadmin).
Create a database named ebookstore:
  **sql**:
  CREATE DATABASE ebookstore;

  **create tables**:
  -- Admins table
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Contact table
CREATE TABLE contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    contact VARCHAR(20),
    subject VARCHAR(255),
    message TEXT
);

-- Users table (assumed for display_data.php)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100),
    password VARCHAR(255) NOT NULL
);

-- Books table (assumed for update_prices.php)
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    price DECIMAL(10,2)
);

Insert default admin:
  <?php
  echo password_hash('admin1234', PASSWORD_DEFAULT);
  ?>
Save as hash.php, access http://localhost/my project/ebook project/hash.php, then:
INSERT INTO admins (username, password) VALUES ('admin', '$2y$10$YOUR_HASHED_PASSWORD');

**5. Update connection.php**:
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ebookstore";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

**6. Run the Project**:
Access http://localhost/my project/ebook project/ in your browser.
Admin: http://localhost/my project/ebook project/admin_login.php (use admin/admin1234).
User: http://localhost/my project/ebook project/cart.html or http://localhost/my project/ebook project/index.html

**Contact**:
For issues or suggestions, open an issue on GitHub or contact kumardhobale80@gmail.com.