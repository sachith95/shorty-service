# Shorty-BE

This project is a demo URL shortener service that developed with [Laravel](https://laravel.com/).

## Short URL Algorithm

This project uses md5 algorithm to generate string from current date and time[microtime(https://www.php.net/manual/en/function.microtime.php)] with random characters. that substring from the first 6 characters of the md5 string.

### Features

- create account using email and password
- login using email and password
- generate short URL
- redirect to original URL
- view analytics of generated URLs
- edit/delete URLs
- manage users
- manage roles

### Stack

- [Laravel Passport](https://laravel.com/docs/8.x/passport)
- [Laravel Fractal](https://github.com/spatie/laravel-fractal)
- [Laravel Permission](https://github.com/spatie/laravel-permission)

## Setup

Modify the .env file to add your database and other credentials

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

```

After successful db connection you can run the following command to run the migrations

```bash
php artisan migrate
```

```bash
php artisan passport:install
```

```bash
php artisan db:seed
```

## Issuing Access Token

```bash
php artisan passport:client
```

Using OAuth, you need to generate client ID and secret. that need to be stored in the react application .env file.

## API documentation

To generate API documentation run the following command

[Aglio](https://github.com/danielgtaylor/aglio)

```bash
npm install -g aglio
```

[merge-apib](https://github.com/ValeriaVG/merge-apib)

```bash
npm install -g apibmerge
```

Finally

```bash
composer api-docs
```
