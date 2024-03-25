<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    protected  $guarded = [];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }
}
