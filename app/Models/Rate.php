<?php

namespace App\Models;

use App\Enums\DocumentTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    protected  $guarded = [];


    public function lawyer()
    {
        return $this->belongsTo(User::class, 'lawyer_id');
    }
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function consultation()
    {
        return $this->belongsTo(Document::class, 'document_id')->where('type' , DocumentTypeEnum::consultation);
    }
    public function case()
    {
        return $this->belongsTo(Document::class, 'document_id')->where('type' , DocumentTypeEnum::case);
    }
}
