# 🎓 YouTubeLMS - Learning Management System

<p align="center">
<img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 11">
<img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
<img src="https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5">
<img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
<img src="https://img.shields.io/badge/Status-Ready-success?style=for-the-badge" alt="Status">
</p>

A modern, feature-rich Learning Management System built with Laravel 11, featuring both **Aduca** (Frontend) and **Rocker** (Backend) premium themes.

---

## ✨ Features

### 👨‍💼 Admin Panel
- ✅ Complete dashboard with analytics
- ✅ Category & Subcategory management
- ✅ Instructor approval system
- ✅ Course management & oversight
- ✅ Order management & reporting
- ✅ Site settings & configuration
- ✅ SMTP, Stripe, Google OAuth integration
- ✅ Dark/Light theme support

### 👨‍🏫 Instructor Panel
- ✅ Earnings dashboard
- ✅ Course creation & management
- ✅ Section & lecture management
- ✅ Video upload support
- ✅ Coupon management
- ✅ Student enrollment tracking

### 👨‍🎓 Student Features
- ✅ Course browsing & enrollment
- ✅ Wishlist & cart system
- ✅ Stripe payment integration
- ✅ Video course player
- ✅ Progress tracking
- ✅ Certificate generation

---

## 🚀 Quick Start

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL
- XAMPP/MAMP/WAMP

### Installation

1. **Clone the repository**
```bash
cd /path/to/htdocs
git clone <repository-url> YouTubeLMS
cd YouTubeLMS
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Configure environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Update .env file**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=4306
DB_DATABASE=youtube_lms
DB_USERNAME=root
DB_PASSWORD=
```

5. **Run migrations & seeders**
```bash
php artisan migrate:fresh --seed
```

6. **Build assets**
```bash
npm run build
```

7. **Start development server**
```bash
php artisan serve
```

8. **Access the application**
```
URL: http://127.0.0.1:8000
```

---

## 🔑 Default Credentials

| Role | Email | Password | Login URL |
|------|-------|----------|-----------|
| **Admin** | admin@example.com | password | /admin/login |
| **Instructor** | instructor@example.com | password | /instructor/login |
| **Student** | user@example.com | password | /login |

---

## 📁 Project Structure

```
YouTubeLMS/
├── app/
│   ├── Http/Controllers/     # Controllers (Admin, Instructor, User)
│   ├── Models/               # Eloquent models
│   ├── Repositories/         # Repository pattern
│   ├── Services/             # Business logic
│   └── Helpers/              # Helper functions
├── resources/
│   └── views/
│       ├── frontend/         # Aduca theme (Public pages)
│       ├── backend/          # Rocker theme (Admin/Instructor)
│       ├── layouts/          # Master layouts
│       └── partials/         # Reusable components
├── public/
│   ├── frontend/             # Aduca theme assets
│   ├── backend/              # Rocker theme assets
│   └── build/                # Compiled Vite assets
├── database/
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
└── routes/
    ├── web.php               # Web routes
    └── api.php               # API routes
```

---

## 🛠️ Technology Stack

### Backend
- **Framework:** Laravel 11
- **Language:** PHP 8.2+
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **Architecture:** Repository + Service Pattern

### Frontend
- **Frontend Theme:** Aduca (Bootstrap 5)
- **Backend Theme:** Rocker (Bootstrap 5)
- **Icons:** Line Awesome, Boxicons
- **JavaScript:** jQuery, Alpine.js
- **Build Tool:** Vite
- **CSS:** Tailwind CSS, Bootstrap 5

### Plugins & Libraries
- **Charts:** Chart.js
- **Tables:** DataTables
- **Video Player:** Plyr
- **Carousels:** Owl Carousel
- **Payment:** Stripe
- **Email:** SMTP Configuration

---

## 📚 Documentation

Comprehensive testing and setup documentation available:

- **[TESTING_COMPLETE.md](TESTING_COMPLETE.md)** - Integration completion summary
- **[TEST_REPORT.md](TEST_REPORT.md)** - Detailed test report
- **[QUICK_TEST_GUIDE.md](QUICK_TEST_GUIDE.md)** - 5-minute testing guide
- **[VERIFICATION_CHECKLIST.md](VERIFICATION_CHECKLIST.md)** - Complete verification checklist

---

## 🧪 Testing Status

### ✅ Automated Tests: 7/7 Passed

- ✅ Database migrations & seeding
- ✅ Asset compilation (Vite)
- ✅ Route configuration
- ✅ Authentication system
- ✅ Theme integration
- ✅ Code quality checks
- ✅ Error detection & fixes

**Integration Status:** 🟢 **100% Complete**

---

## 🎨 Themes

### Frontend Theme: Aduca
- Modern, responsive design
- Bootstrap 5 framework
- Line Awesome icons
- Owl Carousel sliders
- Plyr video player
- Isotope filtering

### Backend Theme: Rocker
- Clean admin interface
- Dark/Light mode
- MetisMenu sidebar
- Chart.js analytics
- DataTables integration
- Perfect Scrollbar

---

## 🔐 Security

- CSRF protection enabled
- Password hashing (bcrypt)
- Role-based access control
- Middleware protection
- SQL injection prevention
- XSS protection

---

## 📊 Database Schema

21 tables including:
- Users (Multi-role authentication)
- Categories & Subcategories
- Courses, Sections, Lectures
- Cart & Wishlist
- Orders & Payments
- Coupons
- Settings (SMTP, Stripe, Google)

---

## 🚀 Deployment

### Production Optimization
```bash
# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Build assets
npm run build

# Set permissions
chmod -R 755 storage bootstrap/cache
```

### Environment Variables
Update `.env` for production:
- Set `APP_ENV=production`
- Set `APP_DEBUG=false`
- Update database credentials
- Configure mail settings
- Add Stripe API keys

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 🙏 Credits

- **Laravel Framework** - [laravel.com](https://laravel.com)
- **Aduca Theme** - Frontend design
- **Rocker Theme** - Backend admin panel
- **Bootstrap** - UI framework
- **Chart.js** - Analytics charts
- **Stripe** - Payment processing

---

## 📞 Support

For issues and questions:
- Check documentation files
- Review `storage/logs/laravel.log`
- Open browser console (F12)
- Create an issue on GitHub

---

<p align="center">Made with ❤️ using Laravel 11</p>

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
