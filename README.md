<h1 align="center">🎉 Event Management System (EMS)</h1>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-7.x-blue?style=flat-square&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-5.x-orange?style=flat-square&logo=mysql">
  <img src="https://img.shields.io/badge/License-MIT-success?style=flat-square">
</p>

<p align="center" style="color: #ccc;">
  <em>A sleek, centralized platform to manage all your event needs with ease.</em>
</p>

---

## 🌌 Overview

The **Event Management System (EMS)** is a fully responsive, web-based application built with **PHP** and **MySQL**, tailored to streamline event planning and management tasks. EMS empowers administrators and users to interact seamlessly through an intuitive dashboard.

---

## ✨ Key Features

### 🔐 Admin Panel
- 📊 Dashboard overview (categories, sponsors, events, users, bookings)
- 📂 Manage Event Categories & Sponsors
- 🗓️ Add/Update Events
- 👥 Manage Users (edit/block)
- ✅ Confirm or Cancel Bookings
- 📰 Post or Delete News Updates
- ⚙️ Update Website Content ("About Us", settings)
- 🛡️ Profile & Password Management

### 🙋 User Panel
- 🔍 Browse Events, News, Contact Info
- 📝 Register & Book Events
- ❌ Cancel Pending Bookings
- 🧾 Manage Profile & Password
- 🔁 Password Recovery

---

## 🛠️ Tech Stack

| Layer       | Technologies                           |
|-------------|-----------------------------------------|
| Frontend    | HTML, CSS, JavaScript, jQuery, AJAX     |
| Backend     | PHP 5.6 / 7.x                           |
| Database    | MySQL 5.x                               |
| Server      | XAMPP / WAMP / MAMP / LAMP              |
| Compatibility | Firefox, Chrome, Edge, Opera          |

---

## 📁 Project Structure

```plaintext
EMS/
├── admin/              # Admin dashboard
├── user/               # User panel
├── includes/           # DB config, common functions
├── css/ js/ images/    # Assets
├── sql/ems.sql         # MySQL dump
└── index.php           # Landing page

## 🚀 Getting Started

### ⚙️ Setup Instructions

1. **Clone the repo**
   ```bash
   git clone https://github.com/kalpsenghani/EventRaze.git

2. **Import the database**

     Go to phpMyAdmin

     Create a new DB: ems

     Import sql/ems.sql

3. **Configure DB Connection 
    
    In includes/dbconfig.php:**

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "ems";
    
4. **Run on Localhost**

     Open browser and visit:

     http://localhost/ems/

🔑 **Admin Access**

Use the following credentials to log in to the Admin Dashboard:

👤 Username: admin
🔒 Password: Test@123