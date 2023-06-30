## Task definitions

Тестовое задание

Необходимо создать проект на Laravel, реализовывать нужно только Backend (REST API), все созданные методы должны быть отображены в коллекции POSTMAN (ее можно добавить в репозиторий в корне проекта)

Техническое задание:

Необходимо создать аутентификацию пользователя с помощью JWT (стандартная таблица users и стандартные средства Laravel).

Необходимо создать систему ролей (roles) и разрешений (permissions). Разрешений может быть произвольное количество и они могу входить в различные роли. Достаточно просто создать методы для создания ролей и добавления к ним разрешений.

Необходимо создать таблицу постов (posts) с полями название (title) и содержание (content).

Реализовать добавление поста пользователем (в посте должен фиксироваться пользователь, который его создал), а также реализовать систему (способ реализации на ваш выбор) того, какие роли имеют разрешение создавать посты.

Требования к заданию:

В качестве БД использовать MySQL.

Использовать концепт паттерна Repository при работе с БД.

Инкапсулировать бизнес логику (если таковая имеется).

Если развертывание проекта отличается от стандартного (присутствуют seeder’ы или artisan-команды) – отобразить схему развертывание в README.

Грамотное оформление кода.
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
