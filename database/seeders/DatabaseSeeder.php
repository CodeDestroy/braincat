<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\Course;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Андрей',
            'secondName' => 'Новичихин',
            'phone'=> '89518531985',
            'email' => 'andrei_novichihin@mail.ru',
            'password' => Hash::make('123')
        ]); */
        /* Course::create([
            'name' => 'Основы теории и практики нейропсихологии',
            'description' => 'Авторский курс д.п.н., профессора Татьяны Григорьевны Визель',
            'image' => '',
            'start_date' => '2024-11-29',
            
            'end_date' => '2025-03-21',
            'start_time' => '8:00:00',
            'end_time' => '21:00:00',
            'status' => 'в процессе набора',
            'price' => 1,
        ]); */
        /* $course = Course::create([
            'name' => 'Основы теории и практики нейропсихологии', 
            'description' => 'Авторский курс д.п.н., профессора Татьяны Григорьевны Визель',
            'image' => '',
            'start_date' => '2024-11-29',
            'end_date' => '2025-03-21',
            'start_time' => '08:00:00',
            'end_time' => '21:00:00',
            'status' => 'inProgress',
            'price' => '30000',
        ]); */
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        //$this->call(UserSeeder::class);
        $this->call(TestSeeder::class);
    }
}
