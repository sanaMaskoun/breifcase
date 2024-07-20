<?php

namespace App\Jobs;

use App\Enums\ConsultationStatusEnum;
use App\Enums\DocumentStatusEnum;
use App\Enums\InvoiceStatusEnum;
use App\Events\RefundConsultationEvent;
use App\Models\Consultation;
use App\Models\Document;
use App\Models\User;
use App\Notifications\RefundConsultationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class RefundConsultationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $consultation;

    public function __construct(Document $consultation)
    {
        $this->consultation = $consultation;
    }

    public function handle()
    {
        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        $data = [
            "consultation_id"   =>   $this->consultation->id,
            "title"             =>  $this->consultation->title
        ];

        $consultation_encoded_id = base64_encode( $this->consultation->id);

        Notification::send($admins, new RefundConsultationNotification($data));
        event(new RefundConsultationEvent($data, $consultation_encoded_id));


        $this->consultation->update([
            'status' => DocumentStatusEnum::rejected,
        ]);
        $this->consultation->invoice()->update([
            'status' => InvoiceStatusEnum::refund,
        ]);
    }

}
