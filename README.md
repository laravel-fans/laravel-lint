# Laravel Lint

[![codecov](https://codecov.io/gh/laravel-fans/laravel-lint/branch/main/graph/badge.svg)](https://codecov.io/gh/laravel-fans/laravel-lint)
[![Laravel 6](https://github.com/laravel-fans/laravel-lint/workflows/Laravel%206/badge.svg)](https://github.com/laravel-fans/laravel-lint/actions)
[![Laravel 7](https://github.com/laravel-fans/laravel-lint/workflows/Laravel%207/badge.svg)](https://github.com/laravel-fans/laravel-lint/actions)
[![Laravel 8](https://github.com/laravel-fans/laravel-lint/workflows/Laravel%208/badge.svg)](https://github.com/laravel-fans/laravel-lint/actions)

Check Code Style(default PSR-12) for Laravel

## install

Run in your Laravel project:

```shell
composer install --dev laravel-fans/lint
php artisan lint:publish
```

## use

lint code:

```shell
php artisan lint:check .
php artisan lint:check app/ tests/
php artisan lint:check --standard=Squiz app/
php artisan lint:staged
```

The default standard is PSR-12, feel free to change the `phpcs.xml`.

lint route URL:

```shell
php artisan lint:route
```

Slug(kebab-case) standard: lowercase ASCII letters, digits, and hyphens (a-z, 0–9, -)
