<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user_1 = User::create([
            "name" => "ali",
            "email" => "Ali@admin.com",
            "password" => Hash::make('123456789'),
            "is_active" => true,
            "type" => UserTypeEnum::admin,
            "created_at" => "2023-08-15 22:54:44",
        ]);
        $user_1->assignRole('admin');

        $user_2 = User::create([
            "name" => "omar",
            "email" => "omar@admin.com",
            "password" => Hash::make('123456789'),
            "is_active" => true,
            "type" => UserTypeEnum::admin,
            "created_at" => "2023-08-15 22:54:44",
        ]);
        $user_2->assignRole('admin');

    }
}
