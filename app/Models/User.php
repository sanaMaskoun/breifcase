<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, HasRoles;

    protected  $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function consultations()
    {

        if ($this->getRoleNames()->first() == 'client') {
            return $this->hasMany(Consultation::class, 'sender_id');
        } else {
            return $this->hasMany(Consultation::class, 'receiver_id');
        }
    }

    public function GeneralQuestions()
    {
        return $this->hasMany(GeneralQuestion::class);
    }


    public function QuestionsReplies()
    {
        return $this->hasMany(QuestionReply::class , 'user_id');
    }
    public function replies()
    {
        return $this->hasMany(QuestionReply::class, 'user_id');
    }


    public function practices(){
        return $this->belongsToMany(Practice::class, 'practice_user', 'user_id', 'practice_id');
    }

    public function rate()
    {
        return $this->hasOne(Rate::class,'employee_id');
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profileUser')
            ->useFallbackUrl(config('app.url') . '/img/user_icon.png')

            ->singleFile();
        $this->addMediaCollection('certification');
    }
}
