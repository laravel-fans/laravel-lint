# Laravel Lint

[![codecov](https://codecov.io/gh/laravel-fans/laravel-lint/graph/badge.svg?token=QJjYkPVnr4)](https://codecov.io/gh/laravel-fans/laravel-lint)
![Packagist Downloads](https://img.shields.io/packagist/dm/laravel-fans/lint)
[![Laravel 9](https://github.com/laravel-fans/laravel-lint/actions/workflows/laravel-9.yml/badge.svg)](https://github.com/laravel-fans/laravel-lint/actions/workflows/laravel-9.yml)
[![Laravel 10](https://github.com/laravel-fans/laravel-lint/actions/workflows/laravel-10.yml/badge.svg)](https://github.com/laravel-fans/laravel-lint/actions/workflows/laravel-10.yml)
[![Laravel 11](https://github.com/laravel-fans/laravel-lint/actions/workflows/laravel-11.yml/badge.svg)](https://github.com/laravel-fans/laravel-lint/actions/workflows/laravel-11.yml)

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
php artisan lint:code app/ tests/ --fix
php artisan lint:phpcs
php artisan lint:pmd
php artisan lint:staged
```

The default standard is `phpcs.xml`, feel free to change it.

### lint route URI

```shell
php artisan lint:route
```

Slug(kebab-case) standard: lowercase ASCII letters, digits, and hyphens (a-z, 0–9, -)
