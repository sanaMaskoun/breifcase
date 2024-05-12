<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Consultation extends Model implements HasMedia
{
    use HasFactory, Notifiable, InteractsWithMedia;
    protected $guarded = [];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function rate()
    {
        return $this->hasOne(Rate::class, 'consultation_id');
    }
    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'consultation_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('files');
        $this->addMediaCollection('translateFile')
            ->singleFile();
    }
}
