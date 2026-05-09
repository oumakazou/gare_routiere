# 🚀 Quick Start Guide - Gare Routière

## ⚡ 5-Minute Setup

### Step 1: Install Dependencies
```bash
cd "Gare Routière"
composer install
npm install
```

### Step 2: Configure Environment
```bash
cp .env.example .env
# Edit .env - set database name, username, password
```

### Step 3: Generate Key & Run Migrations
```bash
php artisan key:generate
php artisan migrate
```

### Step 4: Seed Sample Data
```bash
php artisan db:seed
```

Creates: 8 cities, 3 companies, 3 buses, 11 trips, 3 users

### Step 5: Build Assets & Start Server
```bash
npm run build
php artisan serve
```

✅ **Visit:** http://localhost:8000

---

## 👥 Test Accounts

| Email | Password | Role |
|-------|----------|------|
| admin@example.com | password | Admin |
| client@example.com | password | User |
| jean@example.com | password | User |

---

## 🎯 What's Available Now

### For Users
✅ **Home Page** - Search trips by city, date  
✅ **Voyages List** - Advanced filtering, sorting, pagination  
✅ **Trip Details** - Full information + equipment  
✅ **Booking** - Real-time seat availability check  
✅ **My Reservations** - View all your bookings  

### For Admins
✅ **Dashboard** - Complete admin panel  
✅ **Management** - Cities, Companies, Buses, Trips, Reservations  

---

## 📊 System Features

### Real-Time Features
- ✅ **Seat Availability** - Dynamic calculation
- ✅ **Price Display** - With special offer (+30%)
- ✅ **Status Indicators** - Complet / Low stock / Available
- ✅ **Validation** - Instant feedback

### Search & Filter
- Search by departure city, arrival city, date
- Filter by price range, voyage type, time period
- Sort by date, price, or time
- Pagination (10 results per page)

### Booking System
- Select number of seats
- Choose payment method
- Real-time price calculation
- Instant confirmation
- Validation for seat limits

---

## 📁 Key Files to Know

| File | Purpose |
|------|---------|
| `app/Models/Voyage.php` | Trip model with seat calculations |
| `app/Http/Controllers/VoyageController.php` | Search & listing |
| `app/Http/Controllers/ReservationController.php` | Booking system |
| `resources/views/home.blade.php` | Home & search |
| `resources/views/voyages/index.blade.php` | Advanced listing |
| `resources/views/reservations/create.blade.php` | Booking form |
| `database/seeders/DatabaseSeeder.php` | Sample data |

---

## 🧪 Testing the System

### Test Scenario 1: Book a Trip
1. Log in as `client@example.com`
2. Search for a trip on home page
3. Click "Réserver"
4. Select seats (1-X available)
5. Choose payment method
6. Confirm booking
7. Check "Mes réservations"

### Test Scenario 2: Check Availability
1. Go to "Voyages" page
2. Use filters to find a trip
3. See real-time seat count
4. Try booking with different quantities
5. See validation errors if over limit

### Test Scenario 3: Admin Functions
1. Log in as `admin@example.com`
2. Go to `/admin`
3. Manage trips, reservations, cities, etc.

---

## 💡 Code Examples

### Check Seat Availability
```php
$voyage->available_seats;        // Returns number
$voyage->is_full;                // Boolean
$voyage->canReserveSeats(5);     // Check if possible
$voyage->availability_status;    // "5 places disponibles"
```

### Calculate Price
```php
$voyage->price;           // With special offer applied
$voyage->base_price;      // Original price
$voyage->is_special;      // Boolean
```

### Create Reservation
```php
Reservation::create([
    'user_id' => auth()->id(),
    'voyage_id' => $voyage->id,
    'nombre_places' => 3,
    'total_price' => 3 * $voyage->price,
    'status' => 'confirmee',
]);
```

---

## 🔍 Debugging

### Clear Cache
```bash
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Reset Database
```bash
php artisan migrate:fresh
php artisan db:seed
```

### Check Routes
```bash
php artisan route:list
```

### Database Issues
```bash
php artisan tinker
# Check:
>>> App\Models\Voyage::count()
>>> App\Models\Ville::count()
>>> App\Models\Reservation::count()
```

---

## 📝 Common Tasks

### Add a New Trip
```php
// Via admin panel or:
Voyage::create([
    'ville_depart_id' => 1,
    'ville_arrivee_id' => 2,
    'autocar_id' => 1,
    'type_voyage_id' => 1,
    'date_depart' => now()->addDay(),
    'heure_depart' => '08:00',
    'heure_arrivee' => '12:00',
    'base_price' => 150,
    'is_special' => false,
]);
```

### List Available Trips for Tomorrow
```php
Voyage::where('date_depart', now()->addDay()->toDateString())
       ->where('is_full', false)
       ->get();
```

### Get User's Reservations
```php
Auth::user()->reservations()->with('voyage')->get();
```

---

## 🎨 UI Components

### Availability Badge
```blade
@if($voyage->is_full)
    <span class="text-red-700">Complet</span>
@elseif($voyage->available_seats < 5)
    <span class="text-yellow-700">⚠️ {{ $voyage->available_seats }} places</span>
@else
    <span class="text-green-700">✓ {{ $voyage->available_seats }} places</span>
@endif
```

### Price Display
```blade
{{ number_format($voyage->price, 0) }} MAD
@if($voyage->is_special)
    <small>🎁 +30% (Offre spéciale)</small>
@endif
```

---

## ✅ Production Checklist

Before deploying:
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Set `APP_ENV=production`
- [ ] Generate app key: `php artisan key:generate`
- [ ] Cache config: `php artisan config:cache`
- [ ] Cache routes: `php artisan route:cache`
- [ ] Optimize autoloader: `composer install --optimize-autoloader`
- [ ] Set up HTTPS
- [ ] Configure email for notifications
- [ ] Set up backups
- [ ] Monitor logs

---

## 📞 Need Help?

1. Check `COMPLETE_DOCUMENTATION.md` for detailed info
2. Visit Laravel docs: https://laravel.com/docs
3. Check Tailwind CSS: https://tailwindcss.com/docs
4. Blade templates: https://laravel.com/docs/blade

---

## 🎉 You're All Set!

Your complete bus reservation system is ready to go! 🚌

- ✅ Fully functional
- ✅ Production-ready code
- ✅ Beautiful UI with Tailwind
- ✅ Real-time availability
- ✅ Complete validation
- ✅ Admin panel

**Happy coding! 🚀**
