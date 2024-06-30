<?php
namespace App\Traits;

use App\Models\Message;
use App\Models\User;
use App\Traits\MessageCountInGroupTrait;

trait GetUserGroupTrait
{
    use MessageCountInGroupTrait;

    public function get_user_groups()
    {
        $groups = User::find(Auth()->user()->id)->groups;
        $groups->each(function ($group) {

            $latest_message = Message::where('group_id', $group->id)
            ->latest()
            ->first();

            $message_count = $this->message_count_in_group($group->id);

            $group->message_count = $message_count;
            $group->latest_message = $latest_message;

        });

        return $groups;
    }
}
