# TODO: Fix Database Connection Error

## Issue

-   Laravel is trying to connect to MySQL database 'bidan_fina' which doesn't exist.
-   Error: SQLSTATE[HY000] [1049] Unknown database 'bidan_fina'
-   Sessions are configured to use database driver, but sessions table doesn't exist.

## Plan

1. Change database configuration to use SQLite instead of MySQL.
2. Change session driver to 'file' to avoid needing sessions table in database.
3. Run migrations to set up the database.

## Steps

-   [ ] Edit .env file to set DB_CONNECTION=sqlite and SESSION_DRIVER=file
-   [ ] Run php artisan migrate to create database tables
-   [ ] Test the application to ensure no more database errors
