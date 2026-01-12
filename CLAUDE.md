# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 12 Livewire Starter Kit - a minimal full-stack Laravel application using Livewire 4 and Volt for reactive components. The project includes a PHP code execution environment using FrankenPHP and Monaco Editor.

## Tech Stack

- **Backend**: Laravel 12, PHP 8.2+, Livewire 4 (beta), Volt 1.7
- **Frontend**: TailwindCSS 4, Vite 7, Alpine.js (CDN)
- **Database**: SQLite (default), MySQL supported
- **Testing**: Pest PHP 4
- **Code Style**: Laravel Pint (Laravel preset)

## Development Commands

```bash
# Full development environment (server, queue, logs, vite - all concurrent)
composer run dev

# Individual services
php artisan serve          # Laravel dev server
npm run dev                # Vite with hot reload
php artisan queue:listen --tries=1
php artisan pail --timeout=0   # Real-time log monitoring

# Initial setup
composer run setup         # Install deps, migrate, build assets
```

## Testing

```bash
./vendor/bin/pest                    # Run all tests
./vendor/bin/pest tests/Feature      # Feature tests only
./vendor/bin/pest tests/Unit         # Unit tests only
./vendor/bin/pest --filter=testName  # Run specific test
./vendor/bin/pest --coverage         # With coverage report

# Full test suite with linting
composer run test
```

## Code Quality

```bash
./vendor/bin/pint              # Format code (Laravel preset)
./vendor/bin/pint --test       # Check without modifying
composer run lint              # Parallel linting
```

## Architecture

### Volt Components
Volt provides file-based Livewire components. Components are mounted from two paths (configured in `app/Providers/VoltServiceProvider.php`):
- `resources/views/livewire/`
- `resources/views/pages/`

Volt component files use the `⚡` prefix (e.g., `⚡index.blade.php`) and combine PHP class logic with Blade template in a single file:

```php
<?php
use Livewire\Component;

new class extends Component
{
    public $property;

    public function action() { }
};
?>

<div>
    <!-- Blade template -->
</div>
```

### Routes
Routes are defined in `routes/web.php` using the `Route::livewire()` syntax which maps URLs directly to Volt components.

### PHP Code Execution
The `/string` route demonstrates FrankenPHP integration for executing PHP code via `Symfony\Component\Process\Process`. The FrankenPHP binary is included in the repository root.

## Database

SQLite is the default database. The database file is at `database/database.sqlite`.

```bash
php artisan migrate              # Run migrations
php artisan migrate:refresh      # Reset database
```
