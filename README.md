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

--- 

### How to add a link to the sidebar:

#### To add a __link__ to the sidebar - modify seeds file:  
`my-project/database/seeds/MenusTableSeeder.php`

In `run()` function - add `insertLink()`:
```php
$id = $this->insertLink( $rolesString, $visibleName, $href, $iconString);
```
* `$rolesString` - a string with list of user roles this menu element will be available, ex. `"guest,user,admin"`
* `$visibleName` - a string caption visible in sidebar
* `$href` - a href, ex. `/homepage` or `http://example.com`
* `$iconString` - a string containing valid CoreUI Icon name (kebab-case), ex. `cil-speedometer` or `cil-pencil`

To add a __title__ to the sidebar - use function `insertTitle()`:
```php
$id = $this->insertTitle( $rolesString, $title );
```
* `$rolesString` - a string with list of user roles this menu element will be available, ex. `"guest,user,admin"`
* `$title` - a string caption visible in sidebar

To add a __dropdown__ menu to the sidebar - use function `beginDropdown()`:
```php
$id = $this->beginDropdown( $rolesString, $visibleName, $href, $iconString);
```
* `$rolesString` - a string with list of user roles this menu element will be available, ex. `"guest,user,admin"`
* `$visibleName` - a string caption visible in sidebar
* `$href` - a href, ex. `/homepage` or `http://example.com`
* `$iconString` - a string containing valid CoreUI icon name (kebab-case). For example: `cil-speedometer` or `cil-pencil`

To end dropdown section - use function `endDropdown()`. 

To add __link__ to __dropdown__ call function `insertLink()` between function calls `beginDropdown()` and `endDropdown()`. 
Example:
```php
$id = $this->beginDropdown('guest,user,admin', 'Some dropdown', 'http://example.com', 'cil-puzzle');
$id = $this->insertLink('guest,user,admin', 'Dropdown name', 'http://example.com');
$this->endDropdown();
```

__IMPORTANT__ - At the end of `run()` function, call `joinAllByTransaction()` function:
```php
$this->joinAllByTransaction();
```

Once done with seeds file edit, __run__:
``` bash 
$ php artisan migrate:refresh --seed
# This command also rollbacks database and migrates it again.
```

## Features

### Table of contents:
* Notes
* Users
* Menu management
* Role management
* Management of the media
* BREAD
* Email Templates

#### Notes
It is an example of data presentation in a pagination table, and CRUD functionality.

#### Users
It is a simple example of how to manage registered users.

#### Menu management 
Menu management allows you to toggle the visibility of menu items for individual user roles.

#### Role management
Allows you to create, edit, delete and reorder user roles.
When a user has more than one role, the highest hierarchical role is used to create a menu for him.

#### Manage media
It allows to:
* Create virtual media folders.
* Send media to applications.
* Move media between folders,
* Cut images,

#### BREAD system
BREAD stands for: browse, read, edit, add, delete.
Our BREAD system allows you to easily and quickly generate for any table, from the database, a simple BREAD.
To create a new BREAD just enter a table name from the database.  Then enter a name for the form. Enter the number of rows in the browse table. Choose if you want the browse table to contain buttons: "show", "edit", "add", "delete".
Assign roles for users who will be able to use the ready BREAD.
Then complete each column of the table separately:
* the column name visible to the user,
* the input type for the column,
The last step is to select the appropriate checkboxes:
* browse (allows to display the column in the data table),
* read (allows you to display the column in the show view,)
* edit (enables column editing)
* add (allows you to complete the column data when adding a record. Required if the column is not nullable).
It is also possible to handle relationships with another table.
If the column is a foreign key, it should be specified: in the field "Optional relation table name" - table name to which the foreign key refers, in the "Optional column name in relation table - to print" field - the name of the column that is in the relation table to be displayed. Finally, select one of the two "field types" that relate to the relation: 'relation select' or 'relation radio'.

#### E-mail Templates
It is an example of managing e-mail templates. Allows you to create, edit and delete templates. It also allows you to send an E-mail to a selected address.

### CoreUI Icons Preview & Docs

[https://coreui.io/icons/](https://coreui.io/icons/)
