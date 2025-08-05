<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Jobs\ClearCache;

class Kernel extends ConsoleKernel
{
    /**
     * Определить расписание команд приложения.
     */
    protected function schedule(Schedule $schedule)
    {
        // Здесь задания планировщика
        $schedule->job(ClearCache::class)->hourly();
    }

    /**
     * Зарегистрировать команды для приложения.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
