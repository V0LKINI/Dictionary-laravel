<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrammarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grammars')->insert([
            [
                'name' => 'Present Simple',
                'description' => '<div class="rules__title">
                                    Present Simple — образование
                                    </div>
                                    <div class="rules__text">
                                    Для образования Present Simple используется глагол в первой форме. <br>
                                    <ul>
                                    <li>I drink coffee in the morning. Я пью утром кофе. </li>
                                    <li>You drink coffee in the morning. Ты/Вы пьешь/пьете кофе утром.</li>
                                    <li>They drink coffee in the morning. Они пьют кофе утром.</li>
                                    <li>We drink coffee in the morning. Мы пьем кофе утром.</li>
                                    </ul>
                                    </div>
                                    
                                    <div class="rules__title">
                                    Запомните:
                                    </div>
                                    <div class="rules__text">
                                    1.Простое настоящее время используется в случаях, что составляет вашу повседневную жизнь или по-английски это звучит daily life — daily routine.<br>
                                    2. Никаких окончаний слов /сущ.прилаг./, как в русском или немецком языке, в английском НЕ существует, только буковка -s- у глагола и всё. Это существенно облегчает процесс изучения английского языка.<br>
                                    </div>
                                    
                                    
                                    <div class="rules__title">
                                    Отрицательные предложения в Present Simple 
                                    </div>
                                    <div class="rules__text">
                                    В 3 лице, единственном числе используется конструкция does not. <br>
                                    <ul>
                                    <li>He does not drink coffee in the morning. Он не пьет утром кофе. </li>
                                    <li>She does not drink coffee in the morning. Она не пьет кофе утром.</li>
                                    <li>It does not drink coffee in the morning. Оно не пьет утром кофе.</li>
                                    </ul>
                                    В остальных случая используется do not
                                    <ul>
                                    <li>I do not drink coffee in the morning. Я не пью утром кофе. </li>
                                    <li>You do not drink coffee in the morning. Ты/Вы не пьешь/ пьете кофе утром.</li>
                                    <li>They do not drink coffee in the morning. Они не пьют кофе утром.</li>
                                    </ul>
                                    </div>
                                    
                                    
                                    <div class="rules__title">
                                    Вопросительные предложения в Present Simple
                                    </div>
                                    <div class="rules__text">
                                    В вопросительных предложениях меняется порядок слов. Вспомогательных глагол идёт перед подлежащим<br>
                                    <ul>
                                    <li>Do I drink coffee in the morning?</li>
                                    <li>Do you drink coffee in the morning?</li>
                                    <li>Does he drink coffee in the morning?</li>
                                    </ul>
                                    </div>',
                'level' => 'basic',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Past Simple',
                'description' => ' <div class="rules__title">

                                   </div>
                                   <div class="rules__text">
                                    
                                   </div>',
                'level' => 'basic',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Present perfect',
                'description' => ' <div class="rules__title">

                                   </div>
                                   <div class="rules__text">
                                    
                                   </div>',
                'level' => 'basic',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Present continuous',
                'description' => ' <div class="rules__title">

                                   </div>
                                   <div class="rules__text">
                                    
                                   </div>',
                'level' => 'basic',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Future simple',
                'description' => ' <div class="rules__title">

                                   </div>
                                   <div class="rules__text">
                                    
                                   </div>',
                'level' => 'basic',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
