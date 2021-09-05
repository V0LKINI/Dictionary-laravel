<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExercisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exercises')->insert([
            ['word_id' => 1, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 2, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 3, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 4, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 5, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 6, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 7, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 8, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 9, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 10, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 11, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 12, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 13, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 14, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 15, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 16, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 17, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 18, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 19, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 20, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 21, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 22, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 23, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 24, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 25, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 26, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 27, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 28, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 29, 'english_russian' => 100, 'russian_english' => 100,],
            ['word_id' => 30, 'english_russian' => 100, 'russian_english' => 100,],
        ]);
    }
}
