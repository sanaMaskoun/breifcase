<?php
namespace App\Traits;

use App\Models\Message;
use App\Models\MessageReadStatusInGroup;

trait MessageCountInGroupTrait
{
    public function message_count_in_group($group_id)
    {
        return MessageReadStatusInGroup::where('user_id', Auth()->user()->id)
            ->whereHas('message', function ($query) use ($group_id) {
                $query->where('group_id', $group_id);
            })
            ->where('is_read', false)
            ->count();
    }
}
