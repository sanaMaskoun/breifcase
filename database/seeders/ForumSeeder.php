<?php

namespace Database\Seeders;

use App\Enums\GroupTypeEnum;
use App\Models\Group;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{

    public function run(): void
    {
        Group::create(
            [
                'name' => 'general chat',
                'type' => GroupTypeEnum::general_chat
            ]
        );

    }
}
