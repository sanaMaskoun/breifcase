<?php

namespace Database\Seeders;

use App\Models\Practice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PracticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Practice::create(
            [
                'name' => 'tax',
                'description' => 'Describes tax issues'
            ]
        );
        Practice::create(
            [
                'name' => 'family',
                'description' => 'Describes family issues'
            ]
        );
        Practice::create(
            [
                'name' => 'fraud'
                ,
                'description' => 'Describes fraud issues'
            ]
        );
    }
}
