<p>php8.3, nodejs v18, npm v9</p>


<p>После git clone, в корне проекта:</p>

<ul>
    <li>
        composer install    
    </li>
    <li>
        npm install   
    </li>
</ul>


<p>Файл .env.example переименовываем в .env, редактируем поля под свою БД:</p>
<div>
DB_CONNECTION=sqlite

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=laravel

DB_USERNAME=root

DB_PASSWORD=
</div>

<p>После этого в терминале:</p>
<ul>
    <li>php artisan key:generate</li>
    <li>php artisan db:migrate</li>
    <li>php artisan db:seed</li>
</ul>

<h4>Запуск:</h4>
<p>В одном терминале npm run dev, в другом php artisan serve.</p>

<p>Или же сначала npm run build, потом php artisan serve, тогда не будет работать hot reload</p>
