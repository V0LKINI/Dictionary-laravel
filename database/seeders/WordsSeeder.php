<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $words = [
            ['english' => 'Exaggerated', 'russian' => 'Преувеличенные',],
            ['english' => 'Gal', 'russian' => 'Девчонка',],
            ['english' => 'Flabby', 'russian' => 'Дряблый',],
            ['english' => 'Incantation', 'russian' => 'Заклинание',],
            ['english' => 'Retractable', 'russian' => 'Выдвижной',],
            ['english' => 'Wuss', 'russian' => 'Слабак',],
            ['english' => 'Hesitate', 'russian' => 'Колебаться',],
            ['english' => 'Tan', 'russian' => 'Загар',],
            ['english' => 'Bizarre', 'russian' => 'Странный',],
            ['english' => 'Asylum', 'russian' => 'Убежище',],
            ['english' => 'Ambush', 'russian' => 'Засада',],
            ['english' => 'Whack', 'russian' => 'Сильный удар',],
            ['english' => 'Outlast', 'russian' => 'Пережить',],
            ['english' => 'Tarnish', 'russian' => 'Порочить',],
            ['english' => 'Congregate', 'russian' => 'Собраться',],
            ['english' => 'Phat', 'russian' => 'Суперский',],
            ['english' => 'Reverend', 'russian' => 'Священник',],
            ['english' => 'Deterrent', 'russian' => 'Сдерживающий',],
            ['english' => 'Pledge', 'russian' => 'Залог',],
            ['english' => 'Ditch', 'russian' => 'Ров',],
            ['english' => 'Orchard', 'russian' => 'Фруктовый сад',],
            ['english' => 'Salvation', 'russian' => 'Спасение',],
            ['english' => 'Vacate', 'russian' => 'Освободить',],
            ['english' => 'Frigging', 'russian' => 'поганый',],
            ['english' => 'Grudge', 'russian' => 'Зависть',],
            ['english' => 'Douche bag', 'russian' => 'Придурок',],
            ['english' => 'Dexterity', 'russian' => 'Ловкость',],
            ['english' => 'Midget', 'russian' => 'Лилипут',],
            ['english' => 'Curfew', 'russian' => 'Комендантский час',],
            ['english' => 'Allure', 'russian' => 'Очарование',],
        ];

        foreach ($words as $word){
            $word['user_id'] = '1';
            $word['created_at'] = Carbon::now();
            $word['updated_at'] = Carbon::now();

            $wordId = DB::table('words')->insertGetId($word);

            DB::table('exercises')->insert(
                [
                    'word_id' => $wordId,
                    'english_russian' => 100,
                    'russian_english' => 100,
                    'puzzle' => 100,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }


    }
}
