<?php

namespace App\Jobs;

use App\Enums\ConsultationStatusEnum;
use App\Http\Services\FatoorahService;
use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RefundConsultationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $consultation;

    public function __construct(Consultation $consultation)
    {
        $this->consultation = $consultation;
    }

    public function handle()
    {
        $refund = FatoorahService::refundPayment($this->consultation->payment_id);

        $this->consultation->update([
            'status' => ConsultationStatusEnum::rejected,
            // 'refund_id' => $refund->id,
        ]);
    }

}
