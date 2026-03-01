# Restaurant Website Demo

Production-ready restaurant web app built with Laravel, including a branded public website, themed authentication, session cart, and authenticated ordering.

## Contents

1. [Overview](#overview)
2. [Feature Set](#feature-set)
3. [Tech Stack](#tech-stack)
4. [Project Structure](#project-structure)
5. [Local Setup](#local-setup)
6. [Environment Configuration](#environment-configuration)
7. [Database](#database)
8. [Routing Reference](#routing-reference)
9. [Cart and Checkout Flow](#cart-and-checkout-flow)
10. [Testing and Quality](#testing-and-quality)
11. [Deployment Notes](#deployment-notes)
12. [Screenshots](#screenshots)

## Overview

This project is a complete restaurant website starter that supports:

- Brand-focused marketing pages
- Modern authentication pages consistent with site design
- Menu-driven cart behavior
- Account-based order placement and tracking

It is suitable as a strong company baseline while waiting for final business copy, photos, and menu data.

## Feature Set

### Public Website

- Home, Menu, About, Reservations, Gallery, Contact
- Premium visual theme with reusable restaurant layout
- Cart entry points directly from menu items

### Authentication

- Custom themed `Login` and `Register`
- Laravel Fortify-based auth flow
- Guest/authorized navigation behavior

### Cart

- Add items from menu page
- Update quantity
- Remove item
- Clear cart
- Session-backed cart badge in header

### Orders

- Checkout cart into `orders` and `order_items`
- Manual account order creation flow
- User-owned order list and order detail pages
- Authorization guard to prevent cross-user order access

## Tech Stack

- Laravel 12
- PHP 8.2+
- Blade templates
- Tailwind CSS (Vite build)
- SQLite (default local DB)
- Laravel Fortify + Flux UI scaffolding

## Project Structure

```text
app/
  Http/Controllers/
    CartController.php
    OrderController.php
    PageController.php
  Models/
    Order.php
    OrderItem.php
    User.php
  Support/
    MenuCatalog.php

database/migrations/
  ...create_orders_table.php
  ...create_order_items_table.php

resources/views/
  components/layouts/
    restaurant.blade.php
    restaurant-auth.blade.php
  pages/restaurant/
    home.blade.php
    menu.blade.php
    cart.blade.php
    ...
  orders/
    index.blade.php
    create.blade.php
    show.blade.php
```

## Local Setup

1. Install dependencies:

```bash
composer install
npm install
```

2. Create environment file:

```bash
cp .env.example .env
```

On Windows PowerShell, use:

```powershell
Copy-Item .env.example .env
```

3. Generate app key:

```bash
php artisan key:generate
```

4. Run migrations:

```bash
php artisan migrate
```

5. Build frontend assets:

```bash
npm run build
```

6. Start development server:

```bash
php artisan serve
```

## Environment Configuration

Minimum `.env` values to verify:

- `APP_NAME`
- `APP_ENV`
- `APP_KEY`
- `APP_URL`
- `DB_CONNECTION=sqlite`
- `DB_DATABASE=database/database.sqlite`

If using sqlite and file does not exist:

```powershell
New-Item database\database.sqlite -ItemType File
```

## Database

Primary tables:

- `users`
- `orders`
- `order_items`
- `sessions`

Useful commands:

```bash
php artisan migrate:status
php artisan db:show --counts
php artisan db:table orders
php artisan db:table order_items
```

Quick inspection in Tinker:

```bash
php artisan tinker
```

```php
App\Models\Order::with(['user', 'items'])->latest()->get();
```

## Routing Reference

### Public Routes

- `GET /`
- `GET /menu`
- `GET /about`
- `GET /reservations`
- `GET /gallery`
- `GET /contact`
- `GET /cart`
- `POST /cart/items`
- `PATCH /cart/items/{itemKey}`
- `DELETE /cart/items/{itemKey}`
- `POST /cart/clear`

### Auth Routes

- `GET /login`
- `GET /register`
- `POST /login`
- `POST /register`

### Authenticated Application Routes

- `GET /orders`
- `GET /orders/create`
- `POST /orders`
- `GET /orders/{order}`
- `POST /cart/checkout`

## Cart and Checkout Flow

1. User adds menu items from `/menu`
2. Cart is stored in session (`cart.items`)
3. User opens `/cart` and updates quantities
4. User signs in/registers if needed
5. Checkout posts to `POST /cart/checkout`
6. App creates:
   - `orders` record
   - related `order_items` records
7. Cart session is cleared
8. User is redirected to order detail page

## Testing and Quality

Run all tests:

```bash
php artisan test
```

Run targeted suites:

```bash
php artisan test tests/Feature/CartFlowTest.php
php artisan test tests/Feature/OrderManagementTest.php
php artisan test tests/Feature/PublicPagesTest.php
```

Code style:

```bash
vendor/bin/pint
vendor/bin/pint --test
```

## Deployment Notes

Before deployment:

1. Set production `.env` values
2. Run `composer install --no-dev --optimize-autoloader`
3. Run `php artisan migrate --force`
4. Run `npm run build`
5. Ensure writable permissions for `storage/` and `bootstrap/cache/`
6. Optionally run:
   - `php artisan config:cache`
   - `php artisan route:cache`
   - `php artisan view:cache`

## Screenshots

Add screenshots to `docs/images/` and update links below:

- `docs/images/home.png`
- `docs/images/menu.png`
- `docs/images/cart.png`
- `docs/images/orders.png`
- `docs/images/login.png`

Example markdown:

```markdown
![Home](docs/images/home.png)
```
