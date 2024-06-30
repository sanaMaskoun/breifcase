<?php
namespace App\Traits;

use App\Enums\UserTypeEnum;
use App\Models\Message;
use App\Models\MessageReadStatusInGroup;
use App\Models\User;

trait GetLawyersTrait
{
    public function get_lawyers()
    {
        return User::where('is_active', true)
            ->where('id', '<>', Auth()->user()->id)
            ->whereIn('type', [UserTypeEnum::lawyer , UserTypeEnum::translation_company])
            ->get();
    }
}
