<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Админ', 'email' => 'admin@example.com', 'password' => bcrypt('admin'), 'is_admin' => 1],
            ['name' => 'Тест', 'email' => 'test@test.com', 'password' => bcrypt('test'), 'is_admin' => 0]
        ];

        for ($i=2; $i<100; $i++){
            $users[$i]['name'] = 'test'.$i;
            $users[$i]['email'] = 'Test' . $i . '@test.ru';
            $users[$i]['password'] = bcrypt('test');
            $users[$i]['is_admin'] = 0;
        }

        foreach ($users as $user){
            $user['created_at'] = Carbon::now();
            $user['updated_at'] = Carbon::now();

            $userId = DB::table('users')->insertGetId($user);

            DB::table('experiences')->insert(
                [
                    'user_id' => $userId,
                    'daily_experience' => 0,
                    'weekly_experience' => 0,
                    'monthly_experience' => 0,
                    'total_experience' => 0,
                ],
            );
        }

    }
}
