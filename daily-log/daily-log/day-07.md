Day 07 – User Authentication Planning (Login System)

## What I Did Today

- Learned what user authentication means
- Understood how login and logout work in a web application
- Planned the authentication flow for the CRM system
- Studied how sessions are used to keep users logged in

## Users Planned

- Admin → full system access
- Staff → limited CRM access

## Authentication Flow

1. User enters email and password
2. System checks user details from database
3. Password is verified
4. Session is created after successful login
5. User is redirected to dashboard
6. Session is destroyed on logout

## Security Concepts Learned

- Passwords should be stored in encrypted (hashed) form
- Sessions help track logged-in users
- Unauthorized users should not access protected pages
