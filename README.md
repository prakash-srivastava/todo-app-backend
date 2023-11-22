
## Todo App

It's a Todo list App, in which user can create, list, view and delete a tasks. Its a small project while help you to understand how we can create project in Laravel.

## Getting started

Assuming you've already installed on your machine: PHP (>= 8.2), [Laravel](https://laravel.com) and [Composer](https://getcomposer.org).

``` bash
# install dependencies
composer install

# create .env file and generate the application key
cp .env.example .env
php artisan key:generate
```

Then create the necessary database.

```
php artisan db
create database todo_app
```

And run the initial migrations.

```
php artisan migrate
```

Then launch the server:

``` bash
php artisan serve
```

The Laravel sample project is now up and running! Access it at http://localhost:8000.
