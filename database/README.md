# CyberGuard – Brute Force Attack Detection System

## 📌 Project Description

CyberGuard is a web-based cybersecurity project developed to detect and prevent brute force login attacks.

The system monitors failed login attempts. When a user enters an incorrect password repeatedly, the system counts the failed attempts. After 5 failed attempts, the account is temporarily blocked for 5 minutes.

## 🎯 Objectives

- Detect repeated failed login attempts.
- Prevent brute force password attacks.
- Temporarily block suspicious login activity.
- Store login security information in a MySQL database.
- Provide a simple and easy-to-use login system.

## 🛠️ Technologies Used

- HTML
- CSS
- PHP
- MySQL
- XAMPP
- GitHub

## 🔐 Main Features

- User login authentication
- Failed login attempt counting
- Brute force attack detection
- Temporary account blocking
- MySQL database storage
- Secure database queries using prepared statements

## 📂 Project Structure

```text
CyberGuard-Brute-force-Detection/
│
├── database/
│   └── cyberguard.sql
│
├── db.php
├── index.php
└── README.md
