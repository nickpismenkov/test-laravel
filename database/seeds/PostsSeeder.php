<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Функция добавляет пользователей в отделы
     * 
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 15; $i++)
        {
            DB::table('posts')->insert([
                'users_id' => rand(1,8) . ',' . rand(9, 16),
                'ndepart' => $i,
            ]);
        }
    }
}
