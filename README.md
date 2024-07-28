# Project setup

Note: You should have PHP 8.2 or higher and Composer installed globally on the host machine.

1. Clone this repository and run commands in the root of the project using the terminal:

```
touch database/database.sqlite
cp .env.example .env
```
2. Populate two variables at the end of the new .env file (the values are in the coding test pdf)
```
YEGO_TOKEN=
YEGO_URL=
```
3. Run the laravel installation

```
composer install
```

4. Run the migrations

```
php artisan migrate:fresh
```

5. In the terminal run the command bellow and wait for a few executions:

```
php artisan schedule:work
```

6. Then in the other terminal run the commands bellow, to get the ride's statistic:

```
php artisan command:statistics
``` 

or replace YYYY-MM-DD with the today's date using format YYYY-MM-DD and run:

```
php artisan command:statistics YYYY-MM-DD

``` 
Check the results

7. For running tests please run the command bellow

```
php artisan test
```
