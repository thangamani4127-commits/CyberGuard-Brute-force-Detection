# CyberGuard – Brute Force Attack Detection System

## Project Description

CyberGuard is a web-based Cyber Security project that detects repeated failed login attempts.

If a user enters the wrong password repeatedly, the system counts the failed attempts. After 5 failed attempts, the account is temporarily blocked for 5 minutes.

## Technologies Used

- HTML
- CSS
- PHP
- MySQL
- XAMPP

## Main Features

- User login
- Password verification
- Failed login attempt counting
- Brute force attack detection
- Temporary account blocking
- MySQL database storage

## Database

The project uses a MySQL database named `cyberguard`.

The `users` table stores:

- username
- password
- failed_attempts
- blocked_until

## How It Works

1. User enters username and password.
2. System checks the database.
3. If the password is wrong, failed attempts increase.
4. After 5 failed attempts, the account is blocked.
5. The account is blocked for 5 minutes.
6. After the block period, the user can try again.

## Project Structure

```text
CyberGuard-Brute-force-Detection/
│
├── database/
│   └── cyberguard.sql
│
├── db.php
├── index.php
└── README.md
