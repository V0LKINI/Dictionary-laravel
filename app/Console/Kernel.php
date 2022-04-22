<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            DB::table('experiences')->update(['daily_experience' => 0]);
        })->daily();

        $schedule->call(function () {
            DB::table('experiences')->update([
                'daily_experience' => 0,
                'weekly_experience' => 0,
            ]);
        })->weekly();

        $schedule->call(function () {
            DB::table('experiences')->update([
                'daily_experience' => 0,
                'weekly_experience' => 0,
                'monthly_experience' => 0,
            ]);
        })->monthly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
