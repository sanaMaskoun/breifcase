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
            'name' => 'Lawyer'

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



        Artisan::call('config:cache');
    }
}
