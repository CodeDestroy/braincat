php8.3, nodejs v18, npm v9
После git clone, в корне проекта:
composer install
npm install

Файл .env.example переименовываем в .env, редактируем поля под свою БД:
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

php artisan key:generate
php artisan db:migrate
php artisan db:seed 

В одном терминале npm run dev, в другом php artisan serve.
Или же сначала npm run build, потом php artisan serve, тогда не будет работать hot reload
