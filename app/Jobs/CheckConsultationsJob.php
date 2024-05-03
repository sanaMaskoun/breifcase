<?php

namespace App\Jobs;

use App\Enums\ConsultationStatusEnum;
use App\Models\Consultation;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckConsultationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct()
    {
        //
    }


    public function handle(): void
    {
        $consultations = Consultation::where('status', ConsultationStatusEnum::pending)
            ->where('created_at', '<=', Carbon::now()->subHours(48))
            ->get();

        foreach ($consultations as $consultation) {
            dispatch(new RefundConsultationJob($consultation));
        }
    }
}
