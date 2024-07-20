<?php

namespace App\Console\Commands;

use App\Enums\DocumentStatusEnum;
use App\Enums\DocumentTypeEnum;
use App\Jobs\RefundConsultationJob;
use App\Models\Consultation;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RefundConsultationCommand extends Command
{
    protected $signature = 'refundConsultation';


    protected $description = 'Refund consultations if not answered within 48 hours';


    public function handle()
    {
        $consultations = Document::where('status', DocumentStatusEnum::pending)
        ->where('type', DocumentTypeEnum::consultation)
        ->where('created_at', '<=', Carbon::now()->subMinute())
        ->get();
        foreach ($consultations as $consultation) {
            dispatch(new RefundConsultationJob($consultation));
        }
    }
}
