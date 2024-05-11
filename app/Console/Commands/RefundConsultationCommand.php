<?php

namespace App\Console\Commands;

use App\Enums\ConsultationStatusEnum;
use App\Jobs\RefundConsultationJob;
use App\Models\Consultation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RefundConsultationCommand extends Command
{
    protected $signature = 'refundConsultation';


    protected $description = 'Refund consultations if not answered within 48 hours';


    public function handle()
    {
        $consultations = Consultation::where('status', ConsultationStatusEnum::pending)
        ->where('created_at', '<=', Carbon::now()->subHours(48))
        ->get();
        foreach ($consultations as $consultation) {
            dispatch(new RefundConsultationJob($consultation));
        }
    }
}
