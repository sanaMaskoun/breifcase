<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\DocumentStatusEnum;
use App\Enums\DocumentTypeEnum;
use App\Enums\GroupTypeEnum;
use App\Traits\CalculatesAverageRate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, CalculatesAverageRate, HasRoles;

    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function client()
    {
        return $this->hasOne(Client::class, 'user_id');
    }
    public function lawyer()
    {
        return $this->hasOne(Lawyer::class, 'user_id');
    }
    public function consultations_sender()
    {
        return $this->hasMany(Document::class, 'sender_id')
            ->where('type', DocumentTypeEnum::consultation);
    }
    public function consultations_receiver()
    {
        return $this->hasMany(Document::class, 'receiver_id')
            ->where('type', DocumentTypeEnum::consultation);
    }


    public function consultation_ongoing_sender()
    {
        return $this->hasMany(Document::class, 'sender_id')
            ->where('status', DocumentStatusEnum::ongoing)
            ->where('type', DocumentTypeEnum::consultation);

    }
    public function consultation_ongoing_receiver()
    {
        return $this->hasMany(Document::class, 'receiver_id')
            ->where('status', DocumentStatusEnum::ongoing)
            ->where('type', DocumentTypeEnum::consultation);

    }
    public function cases_sender()
    {
        return $this->hasMany(Document::class, 'sender_id')
            ->where('type', DocumentTypeEnum::case );
    }
    public function cases_receiver()
    {
        return $this->hasMany(Document::class, 'receiver_id')
            ->where('type', DocumentTypeEnum::case );
    }

    public function invoice_sender()
    {
        return $this->hasMany(Invoice::class, 'sender_id');
    }
    public function invoice_receiver()
    {
        return $this->hasMany(Invoice::class, 'receiver_id');
    }

    public function general_questions()
    {
        return $this->hasMany(GeneralQuestion::class, 'sender_id');
    }
    public function questions_replies()
    {
        return $this->hasMany(QuestionReply::class, 'user_id');
    }
    public function practices()
    {
        return $this->belongsToMany(Practice::class, 'practice_lawyer', 'lawyer_id', 'practice_id');
    }
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_user', 'user_id', 'language_id');
    }

    public function geta_average_rate()
    {
        return $this->calculateAverageRate($this->id);
    }

    public function sender_message()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
    public function receiver_message()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    ////////////

    public function replies()
    {
        return $this->hasMany(QuestionReply::class, 'user_id');
    }

    public function rate()
    {
        return $this->hasOne(Rate::class, 'employee_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user', 'user_id', 'group_id')->withPivot('is_admin')->where('type', GroupTypeEnum::group);
    }
    public function general_chats()
    {
        return $this->belongsToMany(Group::class, 'group_user', 'user_id', 'group_id')->withPivot('is_admin')->where('type', GroupTypeEnum::general_chat);
    }

    public function read_statuses()
    {
        return $this->hasMany(MessageReadStatusInGroup::class, 'user_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile')
            ->useFallbackUrl(config('app.url') . '/img/user_icon.png')
            ->singleFile();
        $this->addMediaCollection('front_emirates_id')->singleFile();
        $this->addMediaCollection('back_emirates_id')->singleFile();
    }
}
