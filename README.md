### Installation
1. Clone the repo
2. run `composer install`
3. create the `.env` file from `.env.example`
4. run `php artisan key:generate`
5. set `DB_CONNECTION=sqlite` in `.env` file
6. run `php artisan migrate`
7. run `php artisan db:seed`
   1. a default user will be created with the following credentials:
      1. email: `jdoe@mail.com`
      2. password: `password`
8. run `php artisan filament:install --panels`
9. run `php artisan serve` and navigate to `http://localhost:8000/admin` to login
