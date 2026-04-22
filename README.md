# EvoPlan - Event Planning & Management Platform

<div align="center">

[![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?style=flat-square&logo=php)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-00758F?style=flat-square&logo=mysql)](https://www.mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)

A modern, full-featured event planning and management system built with PHP MVC architecture.

[Features](#features) • [Installation](#installation) • [Configuration](#configuration) • [Architecture](#architecture) • [Contributing](#contributing)

</div>

---

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Project Structure](#project-structure)
- [Architecture](#architecture)
- [API Routes](#api-routes)
- [Database Schema](#database-schema)
- [Usage Guide](#usage-guide)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [Support](#support)
- [License](#license)

---

## 🎯 Overview

**EvoPlan** is a comprehensive event planning and management platform designed to streamline the process of organizing events. The system supports multiple user roles including administrators, service providers, clients, and coordinators, enabling seamless collaboration throughout the event planning lifecycle.

The application is built on a custom PHP MVC (Model-View-Controller) framework, utilizing PDO for database abstraction and implementing modern web development practices.

---

## ✨ Features

### Core Functionality
- **Multi-Role User System**
  - Admin Dashboard with full system management
  - Service Provider Profiles (Decorators, Musicians, Entertainers, Equipment Rental)
  - Client Event Management
  - Coordinator Support
  
- **Event Management**
  - Create, read, update, and delete events
  - Event availability tracking
  - Event notifications and updates
  - Event feedback and ratings system
  
- **Service Marketplace**
  - Browse and book various services (decoration, music, entertainment, equipment)
  - Service provider profiles and portfolios
  - Service ratings and reviews
  - Availability management
  
- **Payment Processing**
  - Multiple payment methods
  - Payment tracking and history
  - Integration with PayHere payment gateway
  - Final payment calculations

- **Communication System**
  - Real-time messaging between clients and service providers
  - Notifications system
  - Issue/complaint management
  - Feedback collection

- **Financial Management**
  - Payment tracking
  - Invoice generation
  - Financial reporting
  - Expense tracking

- **Content Management**
  - Blog/News posts
  - Media uploads (photos, videos)
  - Photo galleries
  - Event documentation

- **Administrative Tools**
  - User management (Admins, Coordinators, Clients, Service Providers)
  - Application approvals
  - Complaint management
  - System statistics and analytics
  - Feature management

---

## 🛠 System Requirements

### Server Requirements
- **PHP**: 7.4 or higher
- **MySQL**: 5.7 or higher
- **Apache**: 2.4+ (with mod_rewrite enabled)
- **Extensions Required**:
  - PDO MySQL
  - cURL (for PayHere integration)
  - GD (for image processing)
  - JSON
  - Session support

### Client Requirements
- Modern web browser (Chrome, Firefox, Safari, Edge)
- JavaScript enabled
- Minimum 1GB RAM
- Stable internet connection

---

## 📦 Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/yourusername/evoplan.git
cd evoplan
```

### Step 2: Create Database

```sql
-- Create new database
CREATE DATABASE evoplan_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Import database schema
mysql -u root -p evoplan_db < database/schema.sql
```

### Step 3: Configure Apache

Ensure the project root is accessible from your Apache web server. Update your Apache configuration to point to the project directory.

### Step 4: Set File Permissions

```bash
# On Linux/Mac
chmod -R 755 app/
chmod -R 755 public/
chmod -R 777 public/uploads/
chmod -R 777 public/img/
```

### Step 5: Verify Installation

Navigate to `http://localhost/evoplan/` in your browser. You should see the EvoPlan landing page.

---

## ⚙️ Configuration

### Database Configuration

Edit [app/config/config.php](app/config/config.php):

```php
define('DB_HOST', 'localhost');     // Database host
define('DB_USER', 'root');          // Database user
define('DB_PASSWORD', '');          // Database password
define('DB_NAME', 'evoplan_db');    // Database name
define('URLROOT','http://localhost/evoplan'); // Application URL
define('SITENAME','EvoPlan');       // Site name
```

### Payment Gateway Configuration

Edit [app/config/payhere.php](app/config/payhere.php) for PayHere payment integration:

```php
define('PAYHERE_MERCHANT_ID', 'YOUR_MERCHANT_ID');
define('PAYHERE_MERCHANT_SECRET', 'YOUR_MERCHANT_SECRET');
define('PAYHERE_RETURN_URL', URLROOT . '/Payment/verify');
define('PAYHERE_NOTIFY_URL', URLROOT . '/Payment/notify');
```

### Email Configuration

Configure SMTP settings in [app/libraries/PHPMailer/](app/libraries/PHPMailer/) for email notifications.

---

## 📁 Project Structure

```
evoplan/
├── app/                          # Application core
│   ├── config/                   # Configuration files
│   │   ├── config.php            # Main configuration
│   │   └── payhere.php           # Payment gateway config
│   ├── controllers/              # MVC Controllers
│   │   ├── Admin.php             # Admin management
│   │   ├── Clients.php           # Client operations
│   │   ├── Users.php             # User management
│   │   ├── Service.php           # Service provider operations
│   │   ├── Payment.php           # Payment processing
│   │   ├── Message.php           # Messaging system
│   │   ├── Posts.php             # Blog/News management
│   │   ├── Cards.php             # Card management
│   │   ├── IssueC.php            # Issue/Complaint management
│   │   └── Package.php           # Package management
│   ├── models/                   # Data Models
│   │   ├── M_admin.php           # Admin data operations
│   │   ├── M_Client.php          # Client data operations
│   │   ├── M_Payment.php         # Payment data operations
│   │   ├── M_Event.php           # Event data operations
│   │   ├── M_Message.php         # Message data operations
│   │   ├── M_Availability.php    # Availability tracking
│   │   ├── M_ratings.php         # Rating system
│   │   └── [Other Models...]     # Additional models
│   ├── views/                    # MVC Views (HTML/PHP Templates)
│   │   ├── Admin/                # Admin panel views
│   │   ├── clients/              # Client views
│   │   ├── users/                # User authentication views
│   │   ├── servicesP/            # Service provider views
│   │   ├── LandingPage/          # Landing page views
│   │   └── inc/                  # Shared components
│   ├── helpers/                  # Helper Functions
│   │   ├── URL_Helper.php        # URL manipulation
│   │   ├── Session_Helper.php    # Session management
│   │   ├── imageUpload_Helper.php# Image upload handling
│   │   └── notification_Helper.php# Notification system
│   ├── libraries/                # Core Libraries
│   │   ├── Core.php              # MVC routing engine
│   │   ├── Database.php          # PDO database wrapper
│   │   ├── Controller.php        # Base controller class
│   │   └── PHPMailer/            # Email library
│   ├── bootloader.php            # Application bootstrap
│   └── .htaccess                 # URL rewriting rules
│
├── public/                       # Web root (publicly accessible)
│   ├── index.php                 # Entry point
│   ├── .htaccess                 # URL rewriting
│   ├── css/                      # Stylesheets
│   │   └── style.css
│   ├── js/                       # JavaScript files
│   │   ├── feedback.js
│   │   ├── LandingPage.js
│   │   └── [Other scripts...]
│   ├── img/                      # Image assets
│   │   ├── Admin/
│   │   ├── client/
│   │   ├── events/
│   │   └── [Other images...]
│   └── uploads/                  # User-generated uploads
│       ├── licenses/
│       └── postsMedia/
│
├── dev/                          # Development utilities
│   ├── sample.txt
│   └── sql.txt
│
├── .htaccess                     # Root URL rewriting
├── .git/                         # Git repository
├── README.md                     # Project documentation
└── .gitignore                    # Git ignore rules
```

---

## 🏗 Architecture

### MVC Pattern

EvoPlan implements the **Model-View-Controller** architectural pattern:

- **Model** (`app/models/`): Handles data operations with the database using PDO
- **View** (`app/views/`): Renders user interface templates
- **Controller** (`app/controllers/`): Processes requests and orchestrates data flow

### Routing System

The application uses URL-based routing through the `Core` class:

```
URL Pattern: /controller/method/parameters
Example: /Clients/viewEvents/2024
```

### Database Layer

- **PDO (PHP Data Objects)** for secure database operations
- Prepared statements to prevent SQL injection
- Connection pooling for performance

---

## 🛣 API Routes

### Authentication Routes
- `GET /Evo/EvoPlan` - Landing page
- `GET /Evo/Client` - Client login
- `GET /Evo/ServiceProvider` - Service provider login
- `GET /Evo/AdminLogin` - Admin login
- `GET /Evo/Register` - User registration
- `GET /Users/Register` - User sign-up

### Client Routes
- `GET/POST /Clients/dashboard` - Client dashboard
- `GET/POST /Clients/viewEvents` - View events
- `POST /Clients/createEvent` - Create new event
- `POST /Clients/bookService` - Book a service
- `GET /Clients/myBookings` - View bookings

### Service Provider Routes
- `GET/POST /Service/dashboard` - Provider dashboard
- `GET /Service/profile` - View profile
- `POST /Service/updateAvailability` - Update availability
- `GET /Service/bookings` - View bookings

### Payment Routes
- `POST /Payment/process` - Process payment
- `POST /Payment/verify` - Verify payment
- `GET /Payment/history` - Payment history

### Admin Routes
- `GET /Admin/dashboard` - Admin dashboard
- `GET /Admin/users` - Manage users
- `GET /Admin/applications` - Manage applications
- `GET /Admin/complaints` - View complaints
- `GET /Admin/stats` - View statistics

### Messaging Routes
- `POST /Message/send` - Send message
- `GET /Message/inbox` - View messages
- `GET /Message/conversation/:id` - View conversation

---

## 🗄 Database Schema

### Core Tables

- **users** - User accounts (clients, service providers)
- **admin** - Administrator accounts
- **coordinators** - Event coordinators
- **events** - Event records
- **services** - Available services
- **bookings** - Service bookings
- **payments** - Payment records
- **messages** - Communication messages
- **ratings** - Service ratings and reviews
- **complaints** - User complaints and issues
- **posts** - Blog posts and news
- **availability** - Service availability schedules

For detailed schema information, see `dev/sql.txt` or the database script in the `dev/` directory.

---

## 📖 Usage Guide

### For Clients

1. **Sign Up**: Navigate to registration and create a client account
2. **Browse Services**: Explore available services and service providers
3. **Create Event**: Define your event details and requirements
4. **Book Services**: Select and book required services
5. **Make Payments**: Complete payment through PayHere gateway
6. **Track Event**: Monitor event progress and communicate with providers
7. **Provide Feedback**: Rate and review services after event completion

### For Service Providers

1. **Register**: Create a service provider account
2. **Complete Profile**: Add services, photos, and qualifications
3. **Manage Availability**: Update your availability calendar
4. **Accept Bookings**: Review and accept client requests
5. **Communicate**: Message clients about event details
6. **Complete Service**: Fulfill the booked service
7. **Receive Feedback**: Get ratings and reviews from clients

### For Administrators

1. **Login**: Access admin panel with credentials
2. **Manage Users**: Add, edit, or remove users
3. **Approve Applications**: Review and approve service provider applications
4. **Monitor Finances**: Track payments and financial reports
5. **Handle Complaints**: Review and resolve user complaints
6. **View Analytics**: Monitor system statistics and trends
7. **Manage Content**: Create news posts and announcements

---

## 🐛 Troubleshooting

### Common Issues

**Issue: 404 Page Not Found**
- Ensure `mod_rewrite` is enabled in Apache
- Check `.htaccess` files are in place
- Verify the controller and method exist

**Issue: Database Connection Error**
- Verify database credentials in `app/config/config.php`
- Ensure MySQL service is running
- Check database user permissions

**Issue: File Upload Fails**
- Verify folder permissions: `chmod -R 777 public/uploads/`
- Check PHP upload_max_filesize setting
- Verify available disk space

**Issue: Email Not Sending**
- Configure SMTP settings in PHPMailer library
- Verify email credentials are correct
- Check firewall rules for SMTP ports

**Issue: Session Lost**
- Ensure session storage directory has write permissions
- Check PHP session.save_path configuration
- Verify browser accepts cookies

---

## 🤝 Contributing

We welcome contributions from the community! Here's how you can help:

### Development Setup

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature`
3. Make your changes and test thoroughly
4. Commit with clear messages: `git commit -m 'Add feature: description'`
5. Push to branch: `git push origin feature/your-feature`
6. Open a Pull Request

### Coding Standards

- Follow PSR-2 coding standards for PHP
- Use meaningful variable and function names
- Add comments for complex logic
- Test all changes before submitting

### Reporting Bugs

Please report bugs by creating an issue with:
- Clear description of the problem
- Steps to reproduce
- Expected vs. actual behavior
- System details (PHP version, MySQL version, etc.)

---

## 💬 Support

For support and questions:

- **Documentation**: Review this README and inline code comments
- **Issues**: Create an issue on the GitHub repository
- **Email**: [Support email if available]
- **Wiki**: Check project wiki for FAQs

---

## 📄 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

### Attribution

- **PHPMailer**: Email library - https://github.com/PHPMailer/PHPMailer
- **PayHere**: Payment gateway - https://www.payhere.lk

---

## 📞 Contact

- **Project Lead**: [Your Name/Organization]
- **Email**: [contact email]
- **Website**: [project website if available]

---

## 🙏 Acknowledgments

Thank you to all contributors, testers, and users who have helped improve EvoPlan!

---

**Last Updated**: April 2026
**Version**: 1.0.0