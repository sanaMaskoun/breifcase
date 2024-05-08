<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected  $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id')->withPivot('is_admin');
    }

    public function messeges()
    {
        return $this->hasMany(Message::class , 'group_id');
    }
}
