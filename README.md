# mhzone

A feature-rich classified ads & marketplace platform built with **Laravel 8** and the **nwidart/laravel-modules** modular architecture.

## Features

- **Classified ads** — post, search, filter and manage ads with categories, child categories, attributes, sizes, tags and custom fields
- **Authentication** — email/password plus social login (Google, Twitter, LinkedIn, GitHub, GitLab, Bitbucket) via Laravel Socialite, and JWT-based API auth
- **Payments** — multi-gateway support: Stripe, Razorpay, Paystack, Flutterwave (Rave), Instamojo, Midtrans, Mollie, PayPal, SSLCommerz
- **User experience** — wishlists, reviews, followers, messenger (chat), newsletters, push notifications (Pusher/Larafirebase)
- **Blog & content** — posts, FAQs, testimonials, CMS pages, SEO management
- **Localization** — multi-language support, currency management, custom timezones
- **Admin panel** — full control over users, plans/subscriptions, coupons, orders, transactions, withdrawals, reports, theme, sliders and settings
- **Analytics** — Google Analytics & Facebook Pixel integration

## Technology Stack

| Layer        | Technology |
|--------------|------------|
| Backend      | PHP 7.3/8.0, Laravel 8 |
| Frontend     | Blade templates, Vue.js 2, Bootstrap 4, Laravel Livewire 2 |
| Build tools  | Laravel Mix (Webpack), SASS |
| Database     | MySQL |
| Auth         | Laravel Auth, Laravel Socialite, tymon/jwt-auth |
| Payments     | Stripe, Razorpay, Paystack, Flutterwave, Instamojo, Midtrans, Mollie, PayPal, SSLCommerz |
| Realtime     | Pusher (Laravel Echo / pusher-js) |
| Notifications| Larafirebase (FCM push notifications) |
| Media/Images | Intervention Image |
| Permissions  | spatie/laravel-permission |
| Testing      | PHPUnit, Collision |

## Project Structure

```
mhzone/
├── app/                    # Core application code
│   ├── Actions/            # Action classes (business logic)
│   ├── Console/            # Artisan commands
│   ├── Events/             # Application events
│   ├── Http/               # Controllers, Livewire, Middleware, Requests, Resources
│   ├── Library/            # Helper libraries
│   ├── Listeners/          # Event listeners
│   ├── Mail/               # Mailables
│   ├── Models/             # Eloquent models (User, Order, Ad, Transaction, ...)
│   ├── Notifications/      # Notification classes
│   ├── Observers/          # Model observers
│   ├── Providers/          # Service providers
│   ├── Rules/              # Validation rules
│   ├── Scopes/             # Query scopes
│   ├── Services/           # Service classes
│   ├── Traits/             # Shared traits
│   └── View/               # View composers / presenters
├── Modules/                # Modular feature packages (nwidart/laravel-modules)
│   ├── Ad/                 # Classified ads module
│   ├── Blog/               # Blog module
│   ├── Brand/              # Brands module
│   ├── Category/           # Categories module
│   ├── ChildCategory/      # Child categories
│   ├── Contact/            # Contact forms
│   ├── Coupon/             # Coupons/discounts
│   ├── Currency/           # Currency management
│   ├── Customer/           # Customer module
│   ├── CustomField/        # Custom ad fields
│   ├── Faq/                # FAQ module
│   ├── Language/           # Multi-language module
│   ├── Map/                # Map integration
│   ├── MobileApp/          # Mobile app config
│   ├── Newsletter/         # Newsletter module
│   ├── Plan/               # Subscription plans
│   ├── PushNotification/   # Push notifications
│   ├── Review/             # Product/listing reviews
│   ├── SetupGuide/         # Installation guide
│   ├── Testimonial/        # Testimonials
│   └── Wishlist/           # Wishlists
├── config/                 # Application & package config
├── database/               # Migrations, factories, seeders
├── public/                 # Public web root
├── resources/              # Views, assets, lang
├── routes/                 # Route files (web, admin, api, auth, payment, ...)
├── storage/                # Logs, cache, uploads
├── tests/                  # PHPUnit tests
└── vendor/                 # Composer dependencies
```

### Module layout

Each module in `Modules/` follows a consistent structure:

```
Modules/<Module>/
├── Actions/        # Module-specific actions
├── Config/         # Module config
├── Console/        # Commands
├── Database/       # Migrations & seeders
├── Entities/       # Eloquent models
├── Http/           # Controllers & requests
├── Providers/      # Service providers
├── Resources/      # Views & assets
├── Routes/         # Module routes
├── Tests/          # Module tests
└── Transformers/   # API transformers
```

## Getting Started

### Prerequisites

- PHP >= 7.3 (with extensions: `bcmath`, `ctype`, `json`, `mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`)
- Composer
- Node.js & NPM
- MySQL

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/mokaddes/mhzone.git
cd mhzone

# 2. Install PHP dependencies
composer install

# 3. Install frontend dependencies
npm install

# 4. Configure environment
cp .env-example .env
php artisan key:generate

# 5. Configure database in .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
#    then run migrations & seeders
php artisan migrate --seed

# 6. Build frontend assets
npm run dev        # development
# npm run prod     # production

# 7. Start the dev server
php artisan serve
```

### Default URLs

- Frontend: `http://localhost:8000`
- Admin panel: `http://localhost:8000/admin`

## Environment Variables

Key settings in `.env`:

| Variable | Description |
|----------|-------------|
| `APP_NAME` | Application name |
| `APP_URL` | Application base URL |
| `APP_TIMEZONE` | Default timezone |
| `APP_CURRENCY` / `APP_CURRENCY_SYMBOL` | Default currency |
| `APP_DEFAULT_LANGUAGE` | Default language |
| `DB_*` | MySQL database connection |
| `PUSHER_*` | Pusher credentials (broadcasting) |
| `*_KEY` / `*_SECRET` / `*_ACTIVE` | Payment gateway credentials (Stripe, Razorpay, Paystack, Flutterwave, Instamojo, Midtrans, Mollie, SSLCommerz) |
| `*_CLIENT_ID` / `*_CLIENT_SECRET` / `*_LOGIN_ACTIVE` | Social login providers |
| `NOCAPTCHA_*` | Google reCAPTCHA credentials |

## Testing

```bash
composer test
```

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).
