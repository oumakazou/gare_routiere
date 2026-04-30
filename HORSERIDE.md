# horseRide - Modern Travel Booking Platform

A modern, responsive travel booking web interface built with Laravel, Blade Templates, and Tailwind CSS.

## 📋 Project Overview

horseRide is a SaaS-style travel booking platform designed for booking trips across Morocco. The interface features a clean, modern design with a blue gradient theme inspired by platforms like Uber and Booking.com.

## 🎨 Design Features

### Color Scheme
- **Primary**: Blue Gradient (600-900)
- **Secondary**: White backgrounds with soft shadows
- **Accent**: Red for discounts/badges
- **Text**: Gray scale (900 for dark, 600 for secondary)

### UI Components
- Sticky navigation header with logo and responsive menu
- Full-width hero section with dark overlay
- Responsive voyage card grid (4 columns desktop, 1 mobile)
- Soft shadows and smooth hover animations
- Rounded corners (lg to xl) throughout
- Professional spacing using Tailwind scale

## 📁 File Structure

```
resources/views/
├── layouts/
│   └── app.blade.php           # Main layout with header and footer
├── components/
│   ├── header.blade.php        # Sticky navigation header
│   ├── hero.blade.php          # Hero section with CTA
│   └── voyage-card.blade.php   # Individual voyage card component
└── home.blade.php              # Home page with voyage grid

app/Http/Controllers/
└── HomeController.php          # Handles home page data
```

## 🚀 Getting Started

### Prerequisites
- PHP 8.1+
- Laravel 11+
- Node.js 18+
- Composer

### Installation

1. **Install Dependencies**
```bash
composer install
npm install
```

2. **Build Assets**
```bash
npm run build
```

3. **Run Development Server**
```bash
php artisan serve
npm run dev
```

The application will be available at `http://localhost:8000`

## 📊 Routes

| Route | Method | Handler | Description |
|-------|--------|---------|-------------|
| `/` | GET | `HomeController@index` | Home page with voyage listings |
| `/dashboard` | GET | Anonymous | User dashboard (requires auth) |
| `/profile` | GET/PATCH/DELETE | `ProfileController` | User profile management |

## 🎯 Components

### Header Component (`header.blade.php`)
- Sticky positioning
- Logo with gradient background
- Responsive navigation menu (hidden on mobile, visible on desktop)
- Mobile hamburger menu
- Auth links (Login/Sign Up buttons)

**Features:**
- Hover effects on links
- Mobile-responsive design
- Semantic HTML structure

### Hero Section (`hero.blade.php`)
- Full-width section (500px mobile, 600px desktop)
- Background image with dark blue overlay (opacity 50%)
- Centered content with title, subtitle, and CTA button
- Responsive typography
- Smooth button animations

### Voyage Card Component (`voyage-card.blade.php`)
**Expected Data Structure:**
```php
[
    'from' => 'Casablanca',
    'to' => 'Rabat',
    'date' => '2026-05-10',
    'time' => '08:00',
    'duration' => '1h 30m',
    'seats' => 12,
    'price' => '120',
    'discount' => 10,  // Optional
    'image' => 'https://...'
]
```

**Card Features:**
- Image with hover zoom effect
- Discount badge (if applicable)
- Route display with arrow icon
- Date/time information
- Duration and available seats
- Price display with "MAD" currency
- Reserve button with hover effects
- Lift effect on hover (transform: -translate-y-2)

### Home Page (`home.blade.php`)
- Hero section integration
- Voyage grid (4-column layout for desktop)
- Filter and sort dropdowns
- Features section (3 columns)
- Call-to-action section
- Fully responsive layout

## 🎭 Dummy Data

The `HomeController` provides 8 sample voyages with:
- **Routes**: Between major Moroccan cities (Casablanca, Rabat, Fès, Marrakech, Tanger, Agadir)
- **Images**: Real travel images from Unsplash
- **Pricing**: MAD currency format (120-280 MAD)
- **Discounts**: 5-20% discounts on select routes
- **Dates**: May 10-11, 2026
- **Times**: Various departure times throughout the day

## 🎨 Tailwind CSS Configuration

The project uses Tailwind CSS with the following key utilities:

### Gradients
- `bg-gradient-to-r from-blue-600 to-blue-700`
- `bg-gradient-to-br from-blue-500 to-blue-600`

### Shadows
- `shadow-md` - Cards at rest
- `shadow-lg`, `shadow-2xl` - On hover

### Responsive Classes
- Mobile-first approach
- `md:` breakpoint for tablets/desktops
- `lg:` breakpoint for large screens

### Spacing
- Uses Tailwind scale (4px increments)
- Consistent margins and padding

## 📱 Responsive Design

### Mobile (< 768px)
- Single-column voyage grid
- Full-width components
- Hamburger menu for navigation
- Stacked footer layout
- Smaller hero section (500px)

### Tablet (768px - 1024px)
- 2-column voyage grid
- Visible desktop navigation
- Medium hero section

### Desktop (> 1024px)
- 4-column voyage grid
- Full navigation visible
- Maximum content width (7xl = 80rem)
- Optimal spacing and typography

## 🔄 Data Flow

1. User visits `/` route
2. `HomeController@index` is called
3. Controller provides dummy voyage data
4. `home.blade.php` extends `layouts/app.blade.php`
5. Components are included with data
6. Tailwind CSS styles are applied via Vite

## 🎯 Future Enhancements

### Phase 1
- [ ] Dynamic voyage data from database
- [ ] User authentication
- [ ] Reservation system
- [ ] Payment integration

### Phase 2
- [ ] Advanced search and filters
- [ ] User reviews and ratings
- [ ] Booking history
- [ ] Email notifications

### Phase 3
- [ ] Mobile app (React Native/Flutter)
- [ ] Admin dashboard
- [ ] Analytics
- [ ] Multi-language support

## 📝 Code Standards

### Blade Templates
- Use semantic HTML5 elements
- Component-based architecture
- Clean indentation (4 spaces)
- Descriptive variable names
- Comments for complex sections

### Tailwind Classes
- Mobile-first approach
- Responsive prefixes (`md:`, `lg:`, `xl:`)
- Consistent color palette
- Proper spacing scale
- Accessibility considerations

### PHP Code
- PSR-12 coding standards
- Type hints for better IDE support
- Meaningful method names
- Clear comments for business logic

## 🔐 Security Considerations

- CSRF tokens in forms (via Blade)
- Secure password hashing (built-in with Laravel)
- SQL injection prevention (Eloquent ORM ready)
- XSS protection (Blade auto-escaping)
- Environment variables for sensitive data

## 🤝 Contributing

1. Create a feature branch
2. Follow existing code standards
3. Test responsive design
4. Document changes
5. Submit pull request

## 📄 License

This project is part of the horseRide platform.

## 👨‍💻 Development Notes

### Building CSS
```bash
npm run build    # Production build
npm run dev      # Development with watch
```

### Useful Commands
```bash
php artisan serve              # Start dev server
php artisan tinker            # Interactive shell
php artisan migrate           # Run migrations
```

### Browser Testing
- Chrome/Edge: Latest versions
- Firefox: Latest versions
- Safari: Latest versions
- Mobile: iOS Safari, Chrome Mobile

---

**Version**: 1.0.0  
**Last Updated**: April 29, 2026  
**Status**: Production Ready ✅
