## Table of Contents
* [Requirements](#Requirements)
* [Installation](#Installation)
* [Usage](#Usage)
* [Features](#Features)

## Requirements
* PHP v7.4.25 (install XAMPP 7)
* Ensures default PHP is 7 (check **PATH** variable in your Windows' System Variables)

## Installation

``` bash
# clone the repo
$ git clone https://github.com/hendrawanap/sistem-manajemen-perumahan.git

# go into app's directory
$ cd sistem-manajemen-perumahan/laravel

# install app's dependencies
$ composer install

# install app's dependencies
$ npm install
```

### Database

1. Install MySQL
2. Create database (ex: sistem_management_perumahan)
3. Update .env file
```bash
# in laravel app directory, copy file ".env.example", and change its name to ".env".
$ cp .env.example .env

```
4. Then in file ".env" complete database configuration:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_management_perumahan
DB_USERNAME=root
DB_PASSWORD=
```

### Next step

``` bash
# in your laravel app directory
# generate laravel APP_KEY
$ php artisan key:generate

# generate jwt secret
$ php artisan jwt:secret

# run database migration and seed
$ php artisan migrate:refresh --seed

```

```bash
# go to coreui directory
$ cd ../coreui

# install app's dependencies
$ npm install

```

## Usage

### Test
``` bash
# test
$ php vendor/bin/phpunit
```

### Run separate frontend & backend

``` bash
# back to laravel directory
$ cd ../laravel

# start local server
$ php artisan serve

$ cd ../coreui

$ npm run serve
```
Open your browser with address: [localhost:8080](localhost:8080)

If you need change backend adress go to file /coreui/src/main.js
And change line:
```js
Vue.prototype.$apiAdress = 'http://127.0.0.1:8000'
```

### When you have project open in browser

Click "Login" on sidebar menu and log in with credentials:

* E-mail: _admin@admin.com_
* Password: _password_

This user has roles: _user_ and _admin_

### CoreUI Icons Preview & Docs

[https://coreui.io/icons/](https://coreui.io/icons/)

## Directory Structures
```bash
# Backend Root Directory
./laravel
```
```bash
# Frontend Root Directory
./coreui
```
