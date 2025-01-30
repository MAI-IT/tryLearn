<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

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

## TryLearn
This is a Simple Learning Management System (LMS) called tryLearn built with Laravel 11. The system supports courses, students, comments, and registrations, with additional features such as authentication, authorization, task scheduling and testing.

## Installation & Setup
### Prerequisites
Ensure you have the following installed:
- PHP 8.1 or later
- Composer
- MySQL or PostgreSQL
- Laravel 11
- A web server (Apache/Nginx) or Laravel Sail (Docker)


## Steps to Set Up Locally

### 1. Clone the repository
git clone https://github.com/MAI-IT/tryLearn
cd tryLearn

### 2. Install dependencies
composer install

### 3. Set up environment variables
### Copy .env.example to .env and update database configurations.
cp .env.example .env

### 4. Generate application key
php artisan key:generate

### 5. Run database migrations and seeders
php artisan migrate --seed

### 6. Start the development server
php artisan serve


## API Endpoints
### 1. Course API Endpoints
- Create: POST /api/courses
- Update: PUT /api/courses/{id}
- Show: GET /api/courses/{id}
- List: GET /api/courses
- Delete: DELETE /api/courses/{id} (soft delete)

### 2. Student API Endpoints
- Create: POST /api/students
- Update: PUT /api/students/{id}
- Show: GET /api/students/{id}

### 3. Comment API Endpoints
- Create: POST /api/comments
- Update: PUT /api/comments/{id}
- List: GET /api/comments
- Delete: DELETE /api/comments/{id}
- 
### 4. Registration API Endpoints
- Create: POST /api/registrations
- Show: GET /api/registrations/{id}
- List: GET /api/registrations
- Update: PUT /api/registrations/{id}

## Authentication
- Login: POST /api/login
- Logout: POST /api/logout
### All course registration and comment actions are protected by authentication.

## Authorization
- Course updates, deletions, and student deletion are restricted by user role (admin/instructor).
- Admin can list and view all registrations. Instructors can view registrations for their courses.
- 
## Task Scheduling
- External Book Data: A scheduled task that fetches books from the Fake Books API daily and stores them in the database.

## Authentication
### This API uses Laravel Sanctum for authentication. To access protected routes:
- 1.Register/Login to get a token.
- 2.Include the token in your requests as:
Authorization: Bearer YOUR_ACCESS_TOKEN

# Testing
Unit and feature tests implemented for the **tryLearn** course API. Each test is designed to ensure that the core functionality of the application is working as expected.

## Deployment
- 1.Configure .env for production settings.
- 2.Set up a web server (e.g., Nginx, Apache).
- 3.Run migrations
- 4.Optimize performance:
   - php artisan config:cache
   - php artisan route:cache
   - php artisan view:cache




