# 🚌 Gare Routière - Bus Reservation System
## Complete Documentation

---

## 📋 Table of Contents
1. [Project Overview](#project-overview)
2. [Features](#features)
3. [Database Structure](#database-structure)
4. [Installation & Setup](#installation--setup)
5. [File Structure](#file-structure)
6. [Models & Relationships](#models--relationships)
7. [Controllers](#controllers)
8. [Views](#views)
9. [Validation Rules](#validation-rules)
10. [Business Logic](#business-logic)
11. [Routes](#routes)

---

## 🎯 Project Overview

**Gare Routière** is a modern, production-ready bus reservation system built with Laravel and Blade templates. It allows users to:
- Search for available bus trips
- View trip details with seat availability
- Make reservations
- Manage their bookings
- Admins can manage all trips and reservations

**Tech Stack:**
- Laravel 11
- Blade Templates
- Tailwind CSS
- MySQL Database
- PHP 8.2+

---

## ✨ Features

### For Users
✅ **Search & Browse**
- Search trips by departure city, arrival city, and date
- View all available trips with advanced filtering
- Real-time seat availability
- Filter by price, time, voyage type

✅ **Reservations**
- Book seats on available trips
- View seat availability before booking
- Multiple payment methods
- Confirm and manage reservations

✅ **Dashboard**
- View all personal reservations
- Reservation status tracking
- Booking history

✅ **Authentication**
- User registration & login
- Secure password handling
- Admin role management

### For Admins
✅ Complete CRUD management of:
- Cities (Villes)
- Companies (Sociétés)
- Buses (Autocars)
- Trips (Voyages)
- Reservations
- Equipment & Options

---

## 🗄️ Database Structure

### Tables

#### `users`
```
- id (PK)
- name
- email (unique)
- password
- is_admin (boolean)
- timestamps
```

#### `villes` (Cities)
```
- id (PK)
- nom (string, unique)
- timestamps
```

#### `societes` (Bus Companies)
```
- id (PK)
- nom (string, unique)
- contact (string, nullable)
- timestamps
```

#### `autocars` (Buses)
```
- id (PK)
- matricule (string, unique)
- capacite (integer)
- type (enum: local, external)
- societe_id (FK)
- timestamps
```

#### `equipements` (Equipment)
```
- id (PK)
- nom (string, unique)
- timestamps
```

#### `autocar_equipements` (Bus-Equipment Link)
```
- id (PK)
- autocar_id (FK)
- equipement_id (FK)
- timestamps
```

#### `options` (Service Options)
```
- id (PK)
- nom (string, unique)
- timestamps
```

#### `autocar_options` (Bus-Options Link)
```
- id (PK)
- autocar_id (FK)
- option_id (FK)
- timestamps
```

#### `type_voyages` (Trip Types)
```
- id (PK)
- nom (string, unique) - normal, express, luxe
- timestamps
```

#### `mode_reglements` (Payment Methods)
```
- id (PK)
- nom (string, unique)
- timestamps
```

#### `voyages` (Trips)
```
- id (PK)
- ville_depart_id (FK)
- ville_arrivee_id (FK)
- autocar_id (FK)
- type_voyage_id (FK)
- date_depart (date)
- heure_depart (time)
- heure_arrivee (time)
- base_price (decimal)
- is_special (boolean) - +30% markup
- timestamps
```

#### `reservations` (Bookings)
```
- id (PK)
- user_id (FK)
- voyage_id (FK)
- nombre_places (integer)
- seat_numbers (json array)
- mode_reglement_id (FK)
- date_reservation (date)
- status (enum: confirmee, en_attente, annulee)
- total_price (decimal)
- timestamps
- indexes: voyage_id, date_reservation
```

---

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.2+
- Composer
- MySQL/MariaDB
- Node.js & npm

### Step 1: Install Dependencies
```bash
cd "Gare Routière"
composer install
npm install
```

### Step 2: Create Environment File
```bash
cp .env.example .env
```

Edit `.env`:
```
DB_DATABASE=gare_routiere
DB_USERNAME=root
DB_PASSWORD=
```

### Step 3: Generate Application Key
```bash
php artisan key:generate
```

### Step 4: Run Migrations
```bash
php artisan migrate
```

### Step 5: Run Seeder (Sample Data)
```bash
php artisan db:seed
```

This creates:
- 8 cities
- 3 bus companies
- 3 buses with equipment & options
- 11 sample trips
- 3 test users

### Step 6: Build Assets
```bash
npm run build
```

### Step 7: Start Development Server
```bash
php artisan serve
```

Visit: `http://localhost:8000`

**Test Accounts:**
- Admin: `admin@example.com` / `password`
- User: `client@example.com` / `password`
- User: `jean@example.com` / `password`

---

## 📁 File Structure

```
app/
├── Http/Controllers/
│   ├── HomeController.php           # Home page & search
│   ├── VoyageController.php         # Trip management
│   ├── ReservationController.php    # Booking system
│   └── Admin/                       # Admin controllers
├── Models/
│   ├── User.php
│   ├── Ville.php                   # City model
│   ├── Voyage.php                  # Trip model (with seat availability)
│   ├── Reservation.php             # Booking model
│   ├── Autocar.php                 # Bus model
│   ├── Societe.php                 # Company model
│   └── ... (other models)

database/
├── migrations/
│   └── 2026_04_29_000004_create_gare_routiere_tables.php
└── seeders/
    └── DatabaseSeeder.php          # Sample data

resources/views/
├── layouts/
│   └── app.blade.php              # Main layout with navbar
├── components/
│   ├── header.blade.php           # Navbar
│   └── flash.blade.php            # Flash messages
├── home.blade.php                 # Home page with search
├── voyages/
│   ├── index.blade.php            # Voyages listing (advanced filters)
│   └── show.blade.php             # Trip details
├── reservations/
│   ├── create.blade.php           # Booking form
│   └── index.blade.php            # My reservations
└── auth/                          # Authentication views

routes/
└── web.php                        # All routes
```

---

## 🔗 Models & Relationships

### Voyage Model
```php
// Relationships
- belongsTo(Ville, 'ville_depart_id')
- belongsTo(Ville, 'ville_arrivee_id')
- belongsTo(Autocar)
- belongsTo(TypeVoyage)
- hasMany(Reservation)

// Calculated Attributes
- price              // Base price or +30% if special
- special_label     // "Offre spéciale" or null
- reserved_seats    // Count of non-cancelled reservations
- available_seats   // Capacity - reserved seats
- is_full          // Boolean
- availability_status // User-friendly status text

// Methods
- canReserveSeats(int) -> bool  // Check if seats available
```

### Reservation Model
```php
// Relationships
- belongsTo(User)
- belongsTo(Voyage)
- belongsTo(ModeReglement)

// Fillable Fields
- user_id
- voyage_id
- nombre_places
- seat_numbers (JSON)
- mode_reglement_id
- date_reservation
- status (confirmee, en_attente, annulee)
- total_price
```

### User Model
```php
// Additional Fields
- is_admin (boolean)

// Relationships
- hasMany(Reservation)
```

---

## 🎮 Controllers

### HomeController
**Purpose:** Display home page with search

**Methods:**
- `index()` - Search trips by city, date

### VoyageController
**Purpose:** List and display trips

**Methods:**
- `index()` - Advanced filtering, sorting, pagination
- `show(Voyage)` - Trip details

### ReservationController
**Purpose:** Manage reservations

**Methods:**
- `index()` - User's reservations
- `create(Voyage)` - Booking form (checks availability)
- `store(Request, Voyage)` - Process booking (validates seats)

---

## 🎨 Views

### Home Page (`home.blade.php`)
- Hero section
- Search form (departure, arrival, date)
- Dynamic voyage cards
- Real-time availability display
- Responsive grid layout

### Voyages List (`voyages/index.blade.php`)
- Advanced sidebar filters
- Price range slider
- Time period filter
- Voyage type filter
- Sorting options
- Paginated results
- Seat availability indicators

### Voyage Details (`voyages/show.blade.php`)
- Full trip information
- Bus details & equipment
- Reservation button (or login prompt)

### Booking Form (`reservations/create.blade.php`)
- Trip summary
- Available seats display
- Seat quantity selector (+/- buttons)
- Payment method selection
- Real-time total calculation
- Validation error messages

### My Reservations (`reservations/index.blade.php`)
- List all user bookings
- Status indicators (confirmed, pending, cancelled)
- Total price display
- Link to view trips

---

## ✔️ Validation Rules

### Reservation Validation
```php
'nombre_places' => ['required', 'integer', 'min:1']
'mode_reglement_id' => ['required', 'exists:mode_reglements,id']
'date_reservation' => ['required', 'date']
```

### Custom Validation
- Max seats: Cannot exceed available seats
- Availability check: Before confirmation
- User authentication: Required for booking

---

## 💼 Business Logic

### Seat Availability Calculation
```
Available Seats = Bus Capacity - Sum(Confirmed Reservations)
```

### Pricing
```
Final Price = Base Price × Number of Seats

If Special Trip (+30%):
Final Price = (Base Price × 1.3) × Number of Seats
```

### Reservation Status
- **confirmee** - Paid and confirmed
- **en_attente** - Pending payment
- **annulee** - Cancelled booking

### Availability Display
- **Complet** - 0 seats
- **⚠️ Plus que X place(s)** - 1-4 seats
- **✓ X places disponibles** - 5+ seats

---

## 🛣️ Routes

### Public Routes
```
GET  /                                  # Home + Search
GET  /voyages                           # All voyages
GET  /voyages/{voyage}                  # Trip details
```

### Authenticated Routes
```
GET    /voyages/{voyage}/reserve        # Booking form
POST   /voyages/{voyage}/reserve        # Submit booking
GET    /mes-reservations                # My bookings
GET    /dashboard                       # Dashboard
GET    /profile                         # User profile
PATCH  /profile                         # Update profile
DELETE /profile                         # Delete account
POST   /logout                          # Logout
```

### Admin Routes
```
GET    /admin                           # Admin dashboard
# CRUD for all models under /admin/*
```

---

## 🎯 How It Works

### User Journey

1. **Browse Trips**
   - User visits home page
   - Searches by departure city, arrival city, date
   - Views results with availability

2. **View Details**
   - Click on trip to see full details
   - Check bus equipment, type, company
   - See current seat availability

3. **Make Reservation**
   - Click "Réserver"
   - Select number of seats (max available)
   - Choose payment method
   - Confirm booking
   - Flash message shows confirmation

4. **View Bookings**
   - Visit "Mes réservations"
   - See all bookings with status
   - View total price and details

### Admin Journey

1. **Manage Trips**
   - Admin dashboard
   - Create new trips
   - Set price, date, company, bus
   - Mark as special offer

2. **Monitor Reservations**
   - View all reservations
   - Change status
   - View user details

3. **System Configuration**
   - Manage cities, companies, buses
   - Add equipment & options
   - Set payment methods

---

## 🔐 Security Features

✅ **Authentication**
- Laravel's built-in auth system
- Password hashing (bcrypt)
- CSRF protection

✅ **Authorization**
- Admin middleware for admin routes
- User middleware for reservations
- Policy-based access control

✅ **Validation**
- Server-side form validation
- Seat availability checks
- Duplicate reservation prevention

✅ **Data Protection**
- Foreign key constraints
- Soft cascading deletes
- JSON storage for seat data

---

## 🐛 Troubleshooting

### "PHP is not recognized"
Fix: Add PHP to Windows PATH or use full path in terminal

### Seeder fails
```bash
php artisan migrate:fresh
php artisan db:seed
```

### Views not loading
```bash
npm run build
php artisan view:clear
```

### Routes not found
```bash
php artisan route:clear
php artisan route:cache
```

---

## 📊 Sample Data

The seeder creates:
- **8 Cities:** Casablanca, Rabat, Fès, Marrakech, Tangier, Agadir, Meknes, Oujda
- **3 Companies:** Atlas, Bus Express, TransMed
- **3 Buses:** 50, 45, 55 capacity
- **11 Trips:** Various routes with different dates/prices
- **3 Payment Methods:** Cash, Card, Online
- **3 Voyage Types:** Normal, Express, Luxury

---

## 🚀 Next Steps & Enhancements

### Planned Features
- [ ] Seat selection UI (visual seat map)
- [ ] Multiple payment gateway integration
- [ ] Email confirmations
- [ ] Trip cancellation & refund system
- [ ] Rating & reviews system
- [ ] Multi-language support
- [ ] SMS notifications
- [ ] API for mobile app

### Performance Optimization
- Add database query optimization
- Implement caching for frequent queries
- Add search indexing

### Testing
- Unit tests for models
- Feature tests for controllers
- Integration tests

---

## 📞 Support

For issues or questions, check:
1. Laravel Documentation: https://laravel.com/docs
2. Tailwind CSS: https://tailwindcss.com/docs
3. Blade Templates: https://laravel.com/docs/blade

---

**Version:** 1.0  
**Last Updated:** May 4, 2026  
**Status:** Production Ready ✅
