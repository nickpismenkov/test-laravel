<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Функция создаёт тестовую учетную запись
     * Так же функия подключает все классы для наполнения базы данных
     * 
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@test.loc',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            UsersTableSeeder::class,
            DepartmentsSeeder::class,
            PostsSeeder::class,
        ]);
    }
}
