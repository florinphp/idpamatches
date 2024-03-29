<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clubs')->insert(
            [
                [
                'name' => 'Down Zero',
                'country' => 'Romania',
                ],
                [
                'name' => 'Double Alpha',
                'country' => 'Italy',
                ],
                [
                'name' => 'Zero Alpha',
                'country' => 'Hungary',
                ],
            ]
        );
    }
}
