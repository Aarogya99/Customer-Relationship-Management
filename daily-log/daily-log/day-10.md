# Day 10 – User Login and Session Handling

## What I Did Today

- Learned how user login works in a web application
- Planned backend logic for user login using PHP
- Studied how sessions are used to keep users logged in
- Understood the logout process

## Login Steps Planned

1. User enters email and password
2. System checks if email exists in database
3. Password is verified using password_verify()
4. Session is created after successful login
5. User is redirected to dashboard
6. Session is destroyed during logout

## Session Concepts Learned

- Sessions store user login information
- session_start() is required to use sessions
- Sessions protect private pages from unauthorized access
