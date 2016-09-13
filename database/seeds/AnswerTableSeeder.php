<?php

use Illuminate\Database\Seeder;
use App\Models\Word;
use App\Models\Answer;

class AnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $words = Word::all();

        foreach ($words as $word) {
            for ($i = 0; $i < 3; $i++) {
                if ($i == 0) {
                    Answer::create([
                        'word_id' => $word->id,
                        'content' => $faker->word,
                        'is_correct' => true,
                        'created_at' => $faker->dateTime($max = 'now'),
                        'updated_at' => $faker->dateTime($max = 'now'),
                    ]);
                }
                Answer::create([
                    'word_id' => $word->id,
                    'content' => $faker->word,
                    'is_correct' => false,
                    'created_at' => $faker->dateTime($max = 'now'),
                    'updated_at' => $faker->dateTime($max = 'now'),
                ]);
            }
        }
    }
}
