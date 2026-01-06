# Prosafe

### ERP system for Kongunad Locker operations

## Building

### Pre-requisites:
1. Install laravel using composer: https://laravel.com/docs/10.x/installation#installation-via-composer
2. Install MySQL v8 server using WSL2 or Docker Desktop
3. It is recommended to setup MySQL reachable on localhost
4. Install HeidiSQL for DB management: https://www.heidisql.com/download.php

### Create a local MySQL database for development

```sql
CREATE DATABASE prosafe;
CREATE USER 'prosafe'@'%' IDENTIFIED BY 'SECRETPASSW0RD';
GRANT ALL ON prosafe.* TO 'prosafe'@'%';
FLUSH PRIVILEGES;
```

### Install application dependencies and DB migration

```sh
git@github.com:Sridhar-Devel/Prosafe.git
cd prosafe

# Update username, password for admin, manager & operator in .env
cp .env.dev .env

composer install
php artisan migrate --seed
php artisan key:generate

php artisan serve

# Access Filament at http://localhost:8000
```

## Running in production

### Server prerequisites

Recommended solution is to deploy in the application in docker using [docker-compose.yml](docker-compose.yml) file.

Set apache DocumentRoot to the Laravel application `public` folder, eg. `/var/www/public`.

Create a MySQL database and user as required. See development DB creation steps for reference.

### Install application dependencies and DB migration

```sh
cd /var
git clone https://git.rsubr.in/rsubr/prosafe.git www
cd www

chown -Rh www-data storage/framework

# Update username, password for admin, manager & operator in .env
cp .env.prod .env
```

### Steps to run inside the docker container

```sh
composer install
php artisan migrate --seed
php artisan key:generate

# Access Filament at https://prosafe.kongunadlocker.com/
```
