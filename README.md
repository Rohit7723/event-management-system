# Event Management System

A RESTful Event Management System built with **Laravel 13** and **Laravel Sanctum** for user authentication. This project allows users to register, log in, create and manage events, and register participants for events.

---

## Features

### Authentication
- User Registration
- User Login
- User Logout
- Token-based Authentication using Laravel Sanctum

### Event Management
- Create Event
- View All Events
- View Event Details
- Update Event
- Delete Event

### Participant Management
- Register Participants for an Event
- Prevent Duplicate Registrations
- View Registered Participants
- Display Participant Count for Each Event

---

## Technology Stack

- PHP 8.3+
- Laravel 12
- Laravel Sanctum
- MySQL
- Composer
- Postman

---

## Project Setup

### 1. Clone the Repository

```bash
git clone https://github.com/Rohit7723/event-management-system.git

cd event-management-system
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Create Environment File

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Configure Database

Update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_management
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Run Database Migrations

```bash
php artisan migrate
```

If you are using the provided SQL file instead of migrations, import:

```
event_management.sql
```

into your MySQL database.

### 7. Start the Development Server

```bash
php artisan serve
```

Application URL:

```
http://127.0.0.1:8000
```

---

## Authentication

This project uses **Laravel Sanctum**.

For protected APIs, include the following header:

```
Authorization: Bearer YOUR_ACCESS_TOKEN
```

---

## API Endpoints

### Authentication

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/register` | Register a new user |
| POST | `/api/login` | Login user |
| GET | `/api/user` | Get authenticated user |
| POST | `/api/logout` | Logout user |

---

### Events

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/events` | Create Event |
| GET | `/api/events` | Get All Events |
| GET | `/api/events/{id}` | Get Event Details |
| PUT | `/api/events/{id}` | Update Event |
| DELETE | `/api/events/{id}` | Delete Event |

---

### Participants

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/events/{event}/participants` | Register Participant |
| GET | `/api/events/{event}/participants` | View Registered Participants |

---

## Sample Request

### Register

```http
POST /api/register
```

```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

---

### Login

```http
POST /api/login
```

```json
{
    "email": "john@example.com",
    "password": "password"
}
```

---

### Create Event

```http
POST /api/events
```

```json
{
    "title": "Laravel Workshop",
    "description": "Laravel REST API Training",
    "event_date": "2026-07-20",
    "location": "Delhi",
    "max_seats": 100,
    "status": "Published"
}
```

---

### Register Participant

```http
POST /api/events/1/participants
```

```json
{
    "name": "Rohit Vishwakarma",
    "email": "rohit@example.com"
}
```

---

## Project Structure

```
app
├── Http
│   └── Controllers
│       ├── AuthController.php
│       └── Api
│           └── EventController.php
│
├── Models
│   ├── User.php
│   ├── Event.php
│   └── Participant.php

database
├── migrations

routes
└── api.php
```

---

## Postman Collection

Import the included Postman collection to test all APIs.

---

## Environment Configuration

A sample environment configuration file is included:

```
.env.example
```

---

## Database

Import the included SQL file if required:

```
event_management.sql
```

---

## Author

**Rohit Vishwakarma**

GitHub Repository:

https://github.com/Rohit7723/event-management-system