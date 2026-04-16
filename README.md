<<<<<<< HEAD
# Movie Seat Reservation System

A modern, responsive movie seat reservation system built with Laravel.

## Features

- Browse available movies with details
- View showtimes for each movie
- Interactive seat selection interface
- Real-time seat availability
- Reservation system with confirmation codes
- Beautiful dark-themed UI with Tailwind CSS

## Requirements

- PHP 8.1+
- Composer
- SQLite/MySQL/PostgreSQL

## Installation

1. Install dependencies:
   ```bash
   composer install
   ```

2. Copy environment file:
   ```bash
   cp .env.example .env
   ```

3. Generate application key:
   ```bash
   php artisan key:generate
   ```

4. Run migrations:
   ```bash
   php artisan migrate
   ```

5. Seed the database with sample data:
   ```bash
   php artisan db:seed
   ```

6. Start the development server:
   ```bash
   php artisan serve
   ```

7. Visit `http://localhost:8000` in your browser

## Usage

### Browse Movies
- Visit the homepage to see all available movies
- Click on a movie to view its details and showtimes

### Select Seats
- Choose a showtime from the available options
- Select your preferred seats from the interactive seating chart
- Seats are color-coded:
  - Green: Available
  - Purple: Selected
  - Red: Reserved

### Complete Reservation
- Fill in your personal information
- Click "Book" to confirm your reservation
- Save your confirmation code for future reference

### View Your Ticket
- Enter your confirmation code to view your ticket details
- Print your ticket for reference

## Database Schema

### Movies
- id, title, description, poster (optional), duration (minutes), genre, release_date

### Shows
- id, movie_id (foreign key), screen_name, show_time, price, total_seats

### Seats
- id, show_id (foreign key), row, number, is_available, price

### Reservations
- id, seat_id (foreign key), customer_name, customer_email, customer_phone, confirmation_code, is_confirmed

## Technologies Used

- **Backend**: Laravel 13
- **Frontend**: Blade Templates + Tailwind CSS
- **Database**: SQLite (default), MySQL, PostgreSQL supported
- **JavaScript**: Vanilla JavaScript for seat selection

## Project Structure

```
app/
├── Http/Controllers/
│   ├── MovieController.php
│   ├── ShowController.php
│   └── ReservationController.php
└── Models/
    ├── Movie.php
    ├── Show.php
    ├── Seat.php
    └── Reservation.php

database/
├── migrations/
│   ├── create_movies_table.php
│   ├── create_shows_table.php
│   ├── create_seats_table.php
│   └── create_reservations_table.php
└── seeders/
    └── DatabaseSeeder.php

resources/views/
├── layouts/
│   └── app.blade.php
├── movies/
│   ├── index.blade.php
│   └── show.blade.php
├── shows/
│   └── seats.blade.php
└── reservations/
    ├── confirmation.blade.php
    └── show.blade.php

routes/
└── web.php
```


