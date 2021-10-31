# Laravel Lint

[![codecov](https://codecov.io/gh/laravel-fans/laravel-lint/branch/main/graph/badge.svg)](https://codecov.io/gh/laravel-fans/laravel-lint)
[![Laravel 6](https://github.com/laravel-fans/laravel-lint/workflows/Laravel%206/badge.svg)](https://github.com/laravel-fans/laravel-lint/actions)
[![Laravel 7](https://github.com/laravel-fans/laravel-lint/workflows/Laravel%207/badge.svg)](https://github.com/laravel-fans/laravel-lint/actions)
[![Laravel 8](https://github.com/laravel-fans/laravel-lint/workflows/Laravel%208/badge.svg)](https://github.com/laravel-fans/laravel-lint/actions)

Check Code Style(default PSR-12) for Laravel

## install

Run in your Laravel project:

```shell
composer require --dev laravel-fans/lint
php artisan lint:publish
```

## usage

### lint code

```shell
php artisan lint:code
php artisan lint:code --fix
php artisan lint:code app/ tests/
php artisan lint:code --standard=Squiz app/
php artisan lint:staged
```

The default standard is `phpcs.xml`, feel free to change it.

### lint route URI

```shell
php artisan lint:route
```

Slug(kebab-case) standard: lowercase ASCII letters, digits, and hyphens (a-z, 0–9, -)
