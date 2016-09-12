<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoryTableSeeder::class);
        $this->call(WordTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LessonTableSeeder::class);
        $this->call(AnswerTableSeeder::class);
    }
}

