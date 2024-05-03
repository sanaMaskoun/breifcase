<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Message extends Model implements HasMedia

{
    use HasFactory ,InteractsWithMedia;
    protected  $guarded = [];

    public function sender()
    {
        return $this->belongsTo(User::class , 'sender_id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class , 'receiver_id');
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments');
    }

}
