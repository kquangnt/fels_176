<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Category;
use App\Models\Lesson;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $startCategory = Category::orderby('created_at')->first();
        $endCategory = Category::orderby('created_at', 'desc')->first();
        $startUser = User::orderby('created_at')->first();
        $endUser = User::orderby('created_at', 'desc')->first();

        for ($i = 0; $i < 4; $i++) {
            Lesson::create([
                'category_id' => mt_rand($startCategory->id, $endCategory->id),
                'user_id' => mt_rand($startUser->id, $endUser->id),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);
        }
    }
}
