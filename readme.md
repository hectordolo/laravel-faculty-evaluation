# Laravel & SB Admin

This is a fresh install of the Laravel 5.3 application using the SB Admin Theme.

## Documentation

### Laravel
Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

### SB Admin 2

This is the CSS Bootstrap theme applied in this applciation.

Source code of SB Admin Bootstrap can be found [Github](https://github.com/BlackrockDigital/startbootstrap-sb-admin-2).

## License

### Laravel
The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

### SB Admin
Copyright 2013-2016 Blackrock Digital LLC. Code released under the [MIT license](https://github.com/BlackrockDigital/startbootstrap-sb-admin-2/blob/gh-pages/LICENSE).

## Installation

* `git clone https://github.com/hectordolo/laravel-sbadmin.git 'PROJECT_DIRECTORY'`
* `cd 'PROJECT_DIRECTORY'`
* `composer install`
* `php artisan key:generate`
* copy .env.example to .env
* edit .env
    * set `DB_DATABASE="YOUR DATABASE NAME"`
    * set `DB_USERNAME="YOUR DATABASE USERNAME"`
    * set `DB_PASSWORD="YOUR DATABASE PASSWORD"`
* `php artisan migrate`
* `php artisan key:generate`
* `php artisan config:clear`
* `php artisan serve`
* You can now register a new user to use the application.
