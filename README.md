# Student Management System - Backend

Laravel RESTful API backend for the Student Management System.
Built as a final requirement for IT15/L — Integrative Programming.

## Setup Instructions
```bash
cd laravel-backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Environment Variables

Configure your `.env` file:
```
DB_DATABASE=your_db_name
DB_USERNAME=root
DB_PASSWORD=your_password
```

## API Base URL
http://127.0.0.1:8000/api

## Built With
- PHP ^8.1
- Laravel ^10.x
- Laravel Sanctum ^3.x
- MySQL ^8.0
