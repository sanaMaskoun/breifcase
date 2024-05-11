<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public $guarded =[];
    public $table = 'invoices';
    public function sender()
    {
        return $this->belongsTo(User::class , 'sender_id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class , 'receiver_id');
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class , 'consultation_id');

    }
}
