[![Ignite](https://raw.githubusercontent.com/Thavarshan/ignite/main/.github/banner.svg)](https://github.com/Thavarshan/ignite)

# Ignite | Forum Builder

## Introduction

Ignite is open source software for building communities and conversation platforms. Communities for your peers, customers, fanbases, families, friends, and any other time and space where people need to come together to be part of a collective.

## Installation

Please check the official **Laravel** installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x/installation#installation)

Clone the repository

```bash
git clone https://github.com/Thavarshan/ignite.git
```

Switch to the repo folder

```bash
cd ignite
```

Install all the dependencies using composer

```bash
composer install
```

Copy the example env file and make the required configuration changes in the .env file

```bash
cp .env.example .env
```

Generate a new application key

```bash
php artisan key:generate
```

Run the database migrations (**Set the database connection in .env before migrating**)

```bash
php artisan migrate
```

Start the local development server

```bash
php artisan serve
```

You can now access the server at http://localhost:8000

**TL;DR command list**

```bash
git clone https://github.com/Thavarshan/ignite.git
cd ignite
composer install
cp .env.example .env
php artisan key:generate
```

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

```bash
php artisan migrate
php artisan serve
```

## Contributing

Thank you for considering contributing to Ignite! You can read the contribution guide [here](.github/CONTRIBUTING.md).

## Security Vulnerabilities

Please review [our security policy](https://github.com/Thavarshan/ignite/security/policy) on how to report security vulnerabilities.

## License

Ignite is open-sourced software licensed under the [MIT license](LICENSE).
