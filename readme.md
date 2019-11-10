## Installation and Configuration

- clone the repository using git clone <repository>.
- Create Empty database in mysql and add database name in .env file along with hostname, port, username and password.

## Install dependencies
```
composer install
```

### create database tables and indexes
```
php artisan migrate
```

### seed players, teams, matches etc
```
php artisan db:seed
```

### now move to the frontend project