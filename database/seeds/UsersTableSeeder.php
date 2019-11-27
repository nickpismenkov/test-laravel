<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Функция создаёт 15 пользователей в таблице users с помощью factory
     * 
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 15)->create()->each(function ($user) {
            $user->make();
        });
    }
}
