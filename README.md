# Laravel Project Setup Guide

This guide will walk you through setting up a Laravel project, including installing Composer, configuring the environment file, migrating and seeding the database, generating an application key, managing storage, and running the development server.

# Tools used for development

- HTML
- CSS
- JavaScript
- Laravel
- VsCode
- Laragon

## Prerequisites

- PHP (>= 7.3)
- Composer
- MySQL or another database supported by Laravel

## Step 1: Install Composer

Composer is a dependency manager for PHP. If you haven't installed Composer yet, download and install it from [getcomposer.org](https://getcomposer.org).

To install Composer dependencies in your project, run the following command in your project directory:
```
composer install
```
## Step 2: Create .env File

The .env file contains environment-specific configuration, such as database connection details. Copy the .env.example file to create a new .env file:
```
cp .env.example .env
```
Next, edit the .env file to configure your database connection:

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=your_database_name
- DB_USERNAME=your_database_user
- DB_PASSWORD=your_database_password

## Step 3: Migrate and Seed the Database

To run the database migrations and seed the database with test data, use the following Artisan command:
```
php artisan migrate:refresh --seed
```
This command will reset the database and run all migrations, then seed it with test data.

## Step 4: Generate Application Key

Laravel requires an application key, which is used for encryption. Generate the application key by running:
```
php artisan key:generate
```
This command will update the APP_KEY value in your .env file.

## Step 5: Run the Development Server

To start the Laravel development server, run the following command:
```
php artisan serve
```
This command will start a local development server at http://127.0.0.1:8000.
