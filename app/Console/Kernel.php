<?php

namespace App\Console;

use App\Jobs\CheckConsultationsJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\RefundConsultationCommand;

class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('refundConsultation')->hourly();

    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
