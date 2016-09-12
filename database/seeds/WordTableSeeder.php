<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Word;

class WordTableSeeder extends Seeder
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

        for ($i = 0; $i < 4; $i++) {
            Word::create([
                'content' => $faker->word,
                'category_id' => mt_rand($startCategory->id, $endCategory->id),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);
        }
    }
}
