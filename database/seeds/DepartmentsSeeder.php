<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Функция для наполнения данными таблицы departments
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 15; $i++)
        {
            DB::table('departments')->insert([
                'name' => $faker->name,
                'description' => Str::random(40),
                'logo' => 'logo/' . rand(1, 4) . '.jpg',
            ]);
        }
    }
}
