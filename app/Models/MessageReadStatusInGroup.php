<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageReadStatusInGroup extends Model
{
    use HasFactory;

    protected  $guarded = [];
    protected $table = 'message_read_status_in_groups';

    public function message()
    {
        return $this->belongsTo(Message::class , 'message_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

}

