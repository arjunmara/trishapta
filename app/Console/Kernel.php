<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\SiteConfig;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\EndDay::class,
        Commands\EndDayNotify::class,
        Commands\TodayTaskNotify::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //Update EndDay = 0, every midnight Nepali Time
        $schedule->command('reset:endday')
            ->dailyAt('00:00')
            ->timezone('Asia/Kathmandu');

        //This will fire today task notification @ 9 AM everyday
        $schedule->command('notify:task')
            ->dailyAt('09:00')
            ->timezone('Asia/Kathmandu');

        //This will fire end day notification @ 3 PM everyday
        $schedule->command('notify:endday')
            ->dailyAt('15:00')
            ->timezone('Asia/Kathmandu');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
