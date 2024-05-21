<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;


class RolesTableSeeder extends Seeder
{

    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Role::create(
            [
                'name' => 'admin'
            ]
        );
        Role::create([
            'name' => 'lawyer'

        ]);
        Role::create([
            'name' => 'legalConsultant'

        ]);
        Role::create([
            'name' => 'typingCenter'

        ]);
        Role::create([
            'name' => 'client'

        ]);
        Role::create([
            'name' => 'translator'

        ]);



        Artisan::call('config:cache');
    }
}
