# Student Management System - Backend

Laravel RESTful API backend for the Student Management System.
Built as a final requirement for IT15/L — Integrative Programming.

## Requirements
* PHP 8.1+
* Composer
* MySQL (XAMPP)
* Node.js (optional)

## Setup Instructions
```bash
cd backend

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate --seed

php artisan serve
```

## Environment Variables (`.env`)
```
APP_NAME=StudentPro
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=acad_portal_db
DB_USERNAME=root
DB_PASSWORD=
```

## Default Admin Account
```
Username: admin
Password: password123
```

## API Endpoints

| Method | Endpoint | Description |
|---|---|---|
| POST | `/api/login` | Login and get token |
| POST | `/api/logout` | Logout (requires token) |
| GET | `/api/dashboard-stats` | Get all dashboard statistics |
| GET | `/api/students` | Get all students |
| POST | `/api/students` | Add new student |
| PUT | `/api/students/{id}` | Update student |
| DELETE | `/api/students/{id}` | Delete student |
| GET | `/api/courses` | Get all courses |
| POST | `/api/courses` | Add new course |
| PUT | `/api/courses/{id}` | Update course |
| DELETE | `/api/courses/{id}` | Delete course |

## Database Seeded Data
* 500+ student records with demographic information
* 20 courses across different programs
* 200+ school day records (academic calendar 2024-2025)

## Built With
- PHP ^8.1
- Laravel ^10.x
- Laravel Sanctum ^3.x
- MySQL ^8.0
