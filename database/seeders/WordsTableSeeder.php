<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('words')->insert([
            ['user_id' => 1, 'english' => 'Exaggregated', 'russian' => 'Преувеличенные',],
            ['user_id' => 1, 'english' => 'Gal', 'russian' => 'Девчонка',],
            ['user_id' => 1, 'english' => 'Flabby', 'russian' => 'Дряблый',],
            ['user_id' => 1, 'english' => 'Incantation', 'russian' => 'Заклинание',],
            ['user_id' => 1, 'english' => 'Retractable', 'russian' => 'Выдвижной',],
            ['user_id' => 1, 'english' => 'Wuss', 'russian' => 'Слабак',],
            ['user_id' => 1, 'english' => 'Hesitate', 'russian' => 'Колебаться',],
            ['user_id' => 1, 'english' => 'Tan', 'russian' => 'Загар',],
            ['user_id' => 1, 'english' => 'Bizarre', 'russian' => 'Странный',],
            ['user_id' => 1, 'english' => 'Asylum', 'russian' => 'Убежище',],
            ['user_id' => 1, 'english' => 'Ambush', 'russian' => 'Засада',],
            ['user_id' => 1, 'english' => 'Whack', 'russian' => 'Сильный удар',],
            ['user_id' => 1, 'english' => 'Outlast', 'russian' => 'Пережить',],
            ['user_id' => 1, 'english' => 'Tarnish', 'russian' => 'Порочить',],
            ['user_id' => 1, 'english' => 'Congregate', 'russian' => 'Собраться',],
            ['user_id' => 1, 'english' => 'Phat', 'russian' => 'Суперский',],
            ['user_id' => 1, 'english' => 'Reverend', 'russian' => 'Священник',],
            ['user_id' => 1, 'english' => 'Deterrent', 'russian' => 'Сдерживающий',],
            ['user_id' => 1, 'english' => 'Pledge', 'russian' => 'Залог',],
            ['user_id' => 1, 'english' => 'Ditch', 'russian' => 'Ров',],
            ['user_id' => 1, 'english' => 'Orchard', 'russian' => 'Фруктовый сад',],
            ['user_id' => 1, 'english' => 'Salvation', 'russian' => 'Спасение',],
            ['user_id' => 1, 'english' => 'Vacate', 'russian' => 'Освободить',],
            ['user_id' => 1, 'english' => 'Frigging', 'russian' => 'поганый',],
            ['user_id' => 1, 'english' => 'Grudge', 'russian' => 'Зависть',],
            ['user_id' => 1, 'english' => 'Douche bag', 'russian' => 'Придурок',],
            ['user_id' => 1, 'english' => 'Dexterity', 'russian' => 'Ловкость',],
            ['user_id' => 1, 'english' => 'Midget', 'russian' => 'Лилипут',],
            ['user_id' => 1, 'english' => 'Curfew', 'russian' => 'Комендантский час',],
            ['user_id' => 1, 'english' => 'Allure', 'russian' => 'Очарование',],
        ]);
    }
}
