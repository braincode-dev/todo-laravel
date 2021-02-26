## ToDo List (Laravel) Install

- git clone https://github.com/braincode-dev/todo-laravel.git
- composer install
- create .env file and copy content from .env.example
- php artisan key:generate
- create a DATABASE and connect to .env

#Important!!!
If you use Mac OS (MAMP server) you need to add this string:
DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock
at the end of file .env

After that you need run this command
- php artisan migrate