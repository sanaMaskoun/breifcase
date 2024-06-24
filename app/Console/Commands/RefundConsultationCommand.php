<?php

namespace App\Console\Commands;

use App\Enums\DocumentStatusEnum;
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
        $consultations = Consultation::where('status', DocumentStatusEnum::pending)
        ->where('created_at', '<=', Carbon::now()->subHours(72))
        ->get();
        foreach ($consultations as $consultation) {
            dispatch(new RefundConsultationJob($consultation));
        }
    }
}
