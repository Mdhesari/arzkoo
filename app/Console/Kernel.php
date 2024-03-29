<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command('queue:work', [
//            '--max-jobs' => 1000,
//            '--max-time' => 3600,
//            '--rest' => 0.5,
//            '--sleep' => 5,
//        ])->everyMinute();
//        $schedule->command('queue:restart')->hourly();
        $schedule->command('sitemap:generate')->daily();
        $schedule->command('backup:clean')->weekly()->at('01:00');
        $schedule->command('backup:run')->weekly()->at('01:30');
        $schedule->command('backup:run --only-db')->weekly()->at('01:30');
        $schedule->command('arzkoo:update-exchanges')->everyTenMinutes();
        $schedule->command('arzkoo:update-top-cryptos')->daily()->at('00:00');
        $schedule->command('scrap:news')->everySixHours();
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
