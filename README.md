# laravel-crud

Laravel CRUD(Create, Read, Update and Delete) with auth. User add new items after complete registration and can view, update and delete from my items.

### Features

* Laravel CRUD using eloquent relationship
* Listing with datatable
* Restriction for user to not access other user data
* Asynchronous search in homepage for guest
* Infinite Scroll in homepage listing

### Installation steps

1) git clone https://github.com/nlagdhir/laravel-crud.git
2) composer update
3) Copy .env.example to .env and set database details in .env file
4) php artisan key:generate
5) If you are using linux then need to give permission to storage and bootstrap folder
6) php artisan migrate
7) php artisan db:seed (Optional : it will create few dummy user and items)

