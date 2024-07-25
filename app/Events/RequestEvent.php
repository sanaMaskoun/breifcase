<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $client_id;
    public $client_name;
    public $document_id;
    public $document_title;
    public $date;
    public $time;
    public $company_id;
    public $document_encoded_id;

    public function __construct($data = [], $document_encoded_id , $company_id  )
    {
        $this->client_id                    = $data['client_id'];
        $this->client_name                  = $data['client_name'];
        $this->document_id              = $data['document_id'];
        $this->document_title           = $data['document_title'];
        $this->company_id                    = $company_id;
        $this->document_encoded_id      = $document_encoded_id;

        $this->date                         = date("j M Y", strtotime(Carbon::now()));
        $this->time                         = date("h:i A", strtotime(Carbon::now()));

    }

    public function broadcastOn()
    {
        return new PrivateChannel('request-channel-'. $this->company_id) ;

    }
}
