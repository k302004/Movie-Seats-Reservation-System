# Movie Seat Reservation System - Specification

## Project Overview

- **Project Name**: StreamFlix - Movie Seat Reservation System
- **Type**: Full-stack Web Application with User & Admin Roles
- **Design**: Netflix-inspired dark theme with red accents
- **Core Functionality**: A movie ticket booking system with user registration, movie browsing, seat selection, and comprehensive admin management

## Technology Stack

- **Backend**: Laravel 13
- **Frontend**: Blade Templates + Tailwind CSS (CDN) + Font Awesome
- **Database**: SQLite (default)
- **PHP Version**: 8.3+

## Design System (Netflix-Inspired)

### Color Palette
- **Primary**: #E50914 (Netflix Red)
- **Background**: #141414 (Dark)
- **Card Background**: #1a1a1a / rgba(30, 30, 30, 0.5)
- **Text Primary**: #FFFFFF
- **Text Secondary**: #B3B3B3 / #808080
- **Success**: #46D369 (Green)
- **Border**: #404040

### Typography
- Font Family: Poppins (Google Fonts)
- Netflix-style bold headings
- Monospace for confirmation codes

## User Features

### 1. Authentication
- [x] User registration with name, email, password
- [x] User login/logout
- [x] Netflix-style login/register pages with dark theme

### 2. Movie Browsing
- [x] Hero banner with movie poster for featured movie
- [x] Grid layout for movie cards with poster images
- [x] Movie ratings display (star rating and numerical score)
- [x] Movie posters displayed from admin-uploaded URLs
- [x] Movie trailers (YouTube embeds from admin-added URLs)
- [x] Movie detail page with poster, trailer section, and full info
- [x] Show seat availability for each showtime

### 3. Showtimes & Booking
- [x] View available showtimes for each movie
- [x] Interactive seat selection with Netflix-style UI
- [x] Color-coded seats (green=available, red=selected, gray=reserved)
- [x] Real-time price calculation for multiple seats
- [x] Complete booking flow with customer information

### 4. Ticket Receipt
- [x] Professional movie ticket receipt design
- [x] Movie poster displayed on receipt
- [x] Confirmation code prominently displayed
- [x] Complete booking details (movie, date, time, screen, seats)
- [x] QR code for entrance scanning
- [x] Total amount and customer information
- [x] Print-friendly layout
- [x] Save confirmation code reminder

### 5. Ticket Management
- [x] Ticket lookup by confirmation code
- [x] View ticket details with movie info, seat, and showtime

## Admin Features

### 1. Admin Dashboard
- [x] Netflix-style sidebar navigation
- [x] Overview statistics cards
- [x] Recent reservations list
- [x] Quick action buttons

### 2. Movie Management
- [x] View all movies in grid layout
- [x] Add new movies with poster URL and trailer URL
- [x] Add movie ratings (0-10 scale)
- [x] Edit existing movies
- [x] Activate/deactivate movies
- [x] Delete movies

### 3. Show Management
- [x] View all shows in table format
- [x] Add new shows with auto-generated seats
- [x] Delete shows (with all associated seats)

### 4. Reservation Management
- [x] View all reservations with detailed customer info
- [x] Customer name prominently displayed
- [x] Customer email and phone number shown
- [x] Movie and show details for each reservation
- [x] Seat information clearly displayed
- [x] Amount paid per seat
- [x] Booking timestamp
- [x] Confirmation code
- [x] Search/view reservations by confirmation code
- [x] View detailed reservation info
- [x] Cancel reservations (releases seats back to available)

## Database Schema

### Movies Table (Updated)
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| title | string | Movie title |
| description | text | Movie description |
| poster | string | Poster image URL |
| video_url | string | Trailer video URL |
| duration | integer | Duration in minutes |
| genre | string | Movie genre |
| release_date | date | Release date |
| rating | decimal | Movie rating (0-10) |
| is_active | boolean | Active status |
| timestamps | | Laravel timestamps |

## UI Components

### Navigation
- Fixed top navigation bar (user-facing)
- Sidebar navigation (admin panel)
- Netflix-style branding with STREAMFLIX logo

### Cards
- Movie cards with hover effects
- Booking summary cards
- Statistics cards

### Forms
- Dark-themed inputs with red focus states
- Form validation with error messages
- Netflix-style buttons (red primary buttons)

### Tables
- Zebra-striped rows
- Hover effects
- Status badges

## Setup Instructions

1. Install dependencies: `composer install`
2. Copy environment: `cp .env.example .env`
3. Generate key: `php artisan key:generate`
4. Run migrations: `php artisan migrate`
5. Seed database: `php artisan db:seed`
6. Start server: `php artisan serve`

### Default Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@movie.com | password |
| User | user@movie.com | password |

## Test Coverage

- [x] Root redirect to movies index
- [x] Movies page loads correctly
- [x] Movie details page loads and displays movie info
- [x] Seat selection page loads
- [x] Reservation lookup page loads
- [x] Login page loads
- [x] Register page loads
- [x] User can register successfully
- [x] User can login successfully
- [x] Admin can access dashboard
- [x] Regular user cannot access admin routes
