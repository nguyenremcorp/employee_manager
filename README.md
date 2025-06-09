
## Requirements
Laravel 12
PHP 8.4

## Run project
Update file env theo local và generate app key:

```shell
copy .env.example .env
php artisan key:generate
```

```shell
composer install
php artisan migrate
php artisan db:seed
```
