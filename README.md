## Requirements

* [OpenServer](https://ospanel.io/) or Xampp or ...
* [Composer](https://getcomposer.org/download/)
* [Postman](https://www.postman.com/downloads/)

## Installation

* #### Basic steps to up project on the local machine
```shell
git clone https://github.com/Shaykhnazar/TestWork2003.git
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
```
