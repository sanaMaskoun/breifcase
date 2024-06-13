<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;


class Template extends Model implements HasMedia
{
    use HasFactory ,InteractsWithMedia;
    protected $guarded = [];
    protected $table = 'templates';


     public function user()
     {
        return $this->belongsTo(User::class , 'user_id');
     }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('template')
            ->singleFile();
        }
}
