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

- Generate APP Key
```
php artisan key:generate
```

- Create database
- Change `.env` database configuration
```
# Change this configuration to match yours
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
  
- Run migration
```
php artisan migrate
```

- Serve the application
```
php artisan serve
```

! Dashboard can be accessed at `/adm`

## Requirement

At least this version is required to run this repo
- PHP 8
- Laravel 10
