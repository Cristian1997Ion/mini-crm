# mini-crm
Welcome to MiniCRM. 
This project uses Laravel + Vue.js.

+ Steps:
1. Clone this repository: <br>
 <code>
    git clone https://github.com/Cristian1997Ion/mini-crm
 </code>
2. Copy .env-example to .env and adjust correctly
3. Run: 
    - <code>npm install & composer install</code>
    - <code>php artisan key:generate</code>
    - <code>php artisan migrate </code> (this generates your tables)
    - <code>php artisan db:seed --class=AdminSeed </code> (this generates default admin)
    - <code>php artisan storage:link</code> (generates symlink for storage in public)
    - <code>php artisan serve</code>
4. At this point you should be able to access localhost:8000
and login with:  admin@admin.com : password

+ More (Generate data): 
    - run: <code>php artisan db:seed --class=ClientsSeed</code> (this generates a list of 50 random clients)
    - run: <code>php artisan db:seed --class=TransactionSeed </code>
    (this generates a list of 30 random transactions if you have at least 1 client in your db)
