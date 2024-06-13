<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FrequentlyQuestion extends Model implements HasMedia
{
    use HasFactory ,InteractsWithMedia;
    protected $guarded = [];
    protected $table = 'frequently_questions';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('frequently_question')
            ->singleFile();

    }

}
