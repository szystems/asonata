# ASONATA - Sports Association Management System

[![Laravel](https://img.shields.io/badge/Laravel-8.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B%7C8.0%2B-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-orange.svg)](https://mysql.com)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

**ASONATA** is a comprehensive sports association management platform built with **Laravel 8**, designed to streamline the administration of athletics organizations. It provides centralized tools for athlete management, event registration, payment processing, team organization, and automated communications.

## Key Features

- **Athlete Management** — Full CRUD with automatic age-based categorization and profile tracking.
- **Event Registration** — Competition sign-up system with automated email notifications and status tracking.
- **Payment Processing** — Financial management module with payment tracking, receipts, and reporting.
- **Team Organization** — Group athletes by categories and skill levels for training and competition.
- **Attendance Tracking** — Training session logging and attendance records for coaches and administrators.
- **Automated Communications** — Email notifications for registrations, payments, and news distribution.
- **Reporting & Export** — Generate PDF and Excel reports for financial summaries, athlete rosters, and event data.

## Technical Architecture

### Tech Stack
| Layer | Technology |
|---|---|
| **Backend** | PHP 8.0+, Laravel 8 (Eloquent ORM, Form Requests, Middleware) |
| **Database** | MySQL 8.0+ (Normalized Schema, Indexed Queries) |
| **Frontend** | Blade Templates, Bootstrap 5, Laravel Mix |
| **PDF/Excel** | DomPDF, Maatwebsite Excel |
| **Authentication** | Laravel Sanctum + Laravel UI |
| **Rich Text** | CKEditor 5 |

### Architecture Highlights
- **Modular Design** — Cleanly separated modules for Athletes, Events, Payments, and Teams following Laravel conventions.
- **Eloquent Relationships** — Complex data relationships (Athlete → Teams → Events → Payments) modeled with Laravel's ORM.
- **Form Request Validation** — Dedicated validation classes ensuring data integrity across all input points.
- **Automated Categorization** — Age-based athlete classification using computed model attributes.
- **Role-Based Access** — Multi-level permissions for Administrators, Coaches, and Staff.

## Getting Started

### Requirements
- PHP 7.4+ (8.0+ recommended)
- Composer 2.0+
- Node.js 14+
- MySQL 8.0+

### Installation
```bash
git clone https://github.com/szystems/asonata.git
cd asonata
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
```

The application will be available at `http://localhost:8000`.

## Documentation

- [ARCHITECTURE.md](ARCHITECTURE.md) — Technical architecture overview
- [MODELS.md](MODELS.md) — Model documentation and relationships
- [PRD.md](PRD.md) — Product Requirements Document

## License

This project is licensed under the MIT License. See [LICENSE](LICENSE) for details.

---

**Built by [Otto Szarata](https://github.com/szystems)** — Senior Full-Stack Developer | Victoria, BC, Canada
