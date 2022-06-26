<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(WordsSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(GrammarTableSeeder::class);
        $this->call(TestWordsSeeder::class);
    }
}
