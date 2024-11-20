<p>php8.3, nodejs v18, npm v9</p>


<p>После <span style='color: green'>git clone</span>, в корне проекта:</p>

<ul>
    <li>
        <span style='color: green'>composer install</span>    
    </li>
    <li>
        <span style='color: green'>npm install</span>   
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
<d>В одном терминале <span style='color: green'>npm run dev</span>, в другом <span style='color: green'>php artisan serve</span>.</p>

<p>Или же сначала <span style='color: green'>npm run build</span>, потом <span style='color: green'>php artisan serve</span>, тогда не будет работать hot reload</p>
