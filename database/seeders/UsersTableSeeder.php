<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                ['name' => 'Админ', 'email' => 'admin@example.com', 'password' => bcrypt('admin'), 'is_admin' => 1],
                ['name' => 'Тест', 'email' => 'test@test.com', 'password' => bcrypt('test'), 'is_admin' => 0]
            ]
        );
    }
}
