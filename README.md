- Clone this project

```
git clone git@github.com:si-aji/basic-laravel.git
```

- Run composer install
```
composer install
```

- Copy `.env.example` to `.env`
```
cp .env.example .env
```

- Generate APP Ket
```
php artisan key:generate
```

- Create database
- Change `.env` database configuration
- Run migration

```
php artisan migrate
```

- Serve the application
```
php artisan server
```

- Dashboard can be accessed at `/adm`

## Requirement

At least this version is required
- PHP 8
- Laravel 10