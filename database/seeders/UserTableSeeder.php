<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user_1 = User::create([
            "first_name" => "ali",
            "last_name" => "ali",
            "email" => "Ali@admin.com",
            "password"=>Hash::make('123456789'),
            "phone" => "097327232",
            "is_active" => true,
            "location" => null,
            "created_at" => "2023-08-15 22:54:44",
        ]);
        $user_1->assignRole('admin');

        $user_2 = User::create([
            "first_name" => "omar",
            "last_name" => "omar",
            "email" => "omar@admin.com",
            "password"=>Hash::make('123456789'),
            "phone" => "097327232",
            "is_active" => true,
            "location" => null,
            "created_at" => "2023-08-15 22:54:44",
        ]);
        $user_2->assignRole('admin');
       
        
    }
}
