<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class QuestionReply extends Model
{
    use HasFactory , Notifiable;
    protected  $guarded = [];

    public function general_question()
    {
        return $this->belongsTo(GeneralQuestion::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
