<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestWordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testUser = DB::table('users')->where('id', 2)->first();

        if ($testUser) {
            $words = [];
            for ($i=0; $i<100; $i++){
                $words[$i]['user_id'] = 2;
                $words[$i]['english'] = 'Test' . $i;
                $words[$i]['russian'] = 'Тест' . $i;
                $words[$i]['created_at'] = Carbon::now();
                $words[$i]['updated_at'] = Carbon::now();
            }

            foreach ($words as $word){
                $wordId = DB::table('words')->insertGetId($word);

                DB::table('exercises')->insert(
                    [
                        'word_id' => $wordId,
                        'english_russian' => 100,
                        'russian_english' => 100,
                        'puzzle' => 100,
                        'created_at' => $word['created_at'],
                        'updated_at' => $word['updated_at'],
                    ]
                );
            }

        }

    }
}
