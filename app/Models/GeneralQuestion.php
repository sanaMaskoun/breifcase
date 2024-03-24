<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralQuestion extends Model
{
    use HasFactory;
    protected  $guarded = [];

    public function Replies()
    {
        return $this->hasMany(QuestionReply::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
