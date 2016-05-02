# EasyAdmin - Advanced Laravel Login and User Management [Screenshots](http://imgur.com/a/kDb5K)

##Server Requirements

In order to install EasyAdmin, your server must meet following requirements:

* PHP >= 5.5.9 (including PHP 7)
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* GD PHP Extension
* Fileinfo PHP Extension

## Quick Start

**Setup Commands**

 1. `git clone https://github.com/Laravelish/EasyAdmin.git`
 2. `composer install`
 3. `npm install`
 4. `bower install`
 5. `cp .env.example .env`
 6. `php artisan key:generate`
 7. `php artisan migrate`
 8. Set administrator info in UserSeeder.php
 9. `php artisan db:seed`
 10. `gulp --production` (Install gulp (sudo npm install -g gulp) if needed)

##Features

 - Secure user registration and login
 - Social Authentication using Facebook, Twitter and Google+
 - Password reset
 - Two-Factor Authentication
 - Remember Me feature on login
 - Login with email or username
 - Google reCAPTCHA on registration
 - Authentication Throttling (lock user account after few incorrect login -  attempts)
 - Interactive Dashboard
 - Unlimited number of user roles
 - Powerful admin panel
 - Unlimited number of permissions
 - Manage permissions from admin interface
 - Assign permission to roles
 - Easily check if user has permission to perform some action
 - User Activity Log
 - Avatar upload with crop feature
 - Built using Twitter Bootstrap
 - Active Sessions Management (see and manage all your active sessions)
 - Full unicode support
 - Client side and server side form validation
 - Fully customisable from settings section
 - Localization support – Translate the application to any language

## Documentation

Documentation can be found [here](http://docs.laravelish.com/easyadmin/installation.html)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).