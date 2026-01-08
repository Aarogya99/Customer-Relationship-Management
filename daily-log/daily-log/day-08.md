# Day 08 – Users Table & Password Hashing Basics

## What I Did Today

- Learned how user data is stored in the database
- Designed the users table for authentication
- Studied password hashing in PHP
- Understood why plain text passwords are unsafe

## Users Table Structure

- id → unique user ID
- name → user full name
- email → login email
- password → hashed password
- role → admin or staff
- created_at → account creation date

## Security Concepts Learned

- Passwords should never be stored as plain text
- PHP provides password_hash() for secure hashing
- password_verify() is used during login
- Hashed passwords protect users even if database is leaked

## Sample Code Studied

```php
$password = password_hash($userPassword, PASSWORD_DEFAULT);
```
