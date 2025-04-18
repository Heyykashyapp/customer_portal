#  Customer Management System (Laravel + MAMP Setup)

A complete Laravel project to manage customer records via RESTful APIs and web UI. Built with Passport for OAuth2 authentication, Scribe for API documentation, and PHPUnit for automated testing.

---

##  Features

- Customer CRUD (Create, Read, Update, Delete)
- OAuth2 Authentication using Laravel Passport
- RESTful API with validation
- UI views using Blade and plain CSS
- Auto-generated API docs using Scribe
- PHPUnit-based API and feature tests

---

##  Setup (MAMP + Laravel)

### 1.  Clone the Project

bash
git clone https://github.com/Heyykashyapp/customer_portal.git
cd customer_portal


 ## Install Dependencies

 composer install


## Configure .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=customer_portal
DB_USERNAME=root
DB_PASSWORD=root

# For mfa email send used mailtrap

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=1a1c0d38bbb212
MAIL_PASSWORD=9a14fece7819b6
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=kashyapp722@gmail.com
MAIL_FROM_NAME="customer portal"


## Install Passport

php artisan passport:install


## API Documentation with Scribe

composer require knuckleswtf/scribe --dev
php artisan vendor:publish --tag=scribe-config

php artisan scribe:generate

then start your server and browse 

http://127.0.0.1:8000/docs


## Run Test Cases

Auth

Create Customer

Update Customer

Delete Customer

Validation & Status Codes

php artisan test


