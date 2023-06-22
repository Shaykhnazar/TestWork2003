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

### **User credentials for testing:**

1. **Admin**
   ```
    email: admin@admin.com
    password: password
   ```
2. **Editor**
   ```
    email: editor@test.com
    password: password
   ```
3. **Viewer**
   ```
    email: viewer@test.com
    password: password
   ```

## Testing
* To run the tests you need to run the command:
```shell
php artisan test
```

## Postman collection
[TestWork2003.postman_collection.json](TestWork2003.postman_collection.json)
