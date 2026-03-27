# Bike Store Management System - PHP

![PHP](https://img.shields.io/badge/PHP-8.0+-blue)
![MySQL](https://img.shields.io/badge/Database-MySQL-green)
![HTML5](https://img.shields.io/badge/HTML5-structure-orange)
![CSS3](https://img.shields.io/badge/CSS3-styling-blueviolet)
![JavaScript](https://img.shields.io/badge/JavaScript-interactivity-yellow)
![License](https://img.shields.io/badge/License-MIT-lightgrey)

A **PHP-based web application** that simulates an online bicycle store, allowing users to browse bikes, submit reviews, and manage store inventory through a responsive web interface.

## Overview

This project demonstrates the integration of **PHP server-side development**, **MySQL database management**, and **responsive front-end design**. It provides a centralized platform where regular users can explore bikes and submit reviews, while authenticated members manage inventory and user accounts efficiently.

## Key Features

* **User Authentication:** Secure login/logout with session management
* **Member Management:** View, create, and delete user accounts
* **Inventory Management:** Insert, edit, and manage bicycles
* **Review System:** Users can submit and read reviews for bicycles
* **Flash Messages:** Real-time success/error notifications for user actions

## Technology Stack

* **Frontend:** HTML5, CSS3, JavaScript
* **Backend:** PHP
* **Database:** MySQL with PDO
* **Version Control:** GitHub

## Project Structure

```
bike-store-management-system-php/
│
├── css/...                  # Stylesheets for the application
├── images/...               # Image assets (bikes, icons, etc.)
├── js/...                   # JavaScript files for interactivity
├── utilities/
│   ├── pdo.php              # Database connection (PDO) - connects to 'veloworld' DB
│   └── header_footer.php    # Reusable header and footer functions
│
├── index.php                # Main landing page
├── about_us.php             # About Us page
├── items_in_stock.php       # Display available bicycles
├── reviews.php              # Display and submit bicycle reviews
├── contact_us.php           # Contact Us page with form
├── member.php               # Member area – manage users
├── login.php                # User login page
├── logout.php               # Session logout handler
├── create_user.php          # Create a new user account
├── edit_items.php           # Edit existing store items
├── insert_item.php          # Insert new items into inventory
├── contact_submit.php       # Handle contact form submissions
└── README.md                # Project documentation
```

## Installation
### Prerequisites

- [WAMP](https://www.wampserver.com/) or [XAMPP](https://www.apachefriends.org/) installed
- PHP 7.4+
- MySQL 5.7+

### Steps

1. **Clone the repository**
    ```bash
    git clone https://github.com/alessioriga/bike-store-management-system-php.git
    ```

2. **Move the project to your server directory**
    ```bash
    # For WAMP or XAMPP, move the folder to:
    C:\wamp64\www\bike-store-management-system-php
    ```

3. **Import the database**
    - Open **phpMyAdmin** at `http://localhost/phpmyadmin`
    - Create a new database named `veloworld`
    - Import the provided `.sql` file into the `veloworld` database

4. **Configure the database connection**
    - Open `utilities/pdo.php`
    - Update the credentials if needed:
    ```php
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=veloworld', 
        'your_username', 'your_password');
    ```

5. **Run the application**
    - Start **WAMP** or **XAMPP** and ensure Apache & MySQL are running
    - Visit `http://localhost/bike-store-management-system-php`

## Demo Credentials

For testing purposes:

- **Email:** `1234@admin.com`
- **Password:** `1234`

## Future Improvements

* Implement a **shopping cart** and checkout system for online purchases.
* Add **user profiles** with order history and saved preferences.
* Password recovery via **email verification**.

## License

This project is licensed under the MIT License.