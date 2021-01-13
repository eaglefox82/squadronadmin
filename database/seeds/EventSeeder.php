<?php

use Illuminate\Database\Seeder;

use App\Eventlevels;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Eventlevels::truncate();

        Eventlevels::create(['id' => 1, 'level' => 'Squadron Optional', 'points_rank' => '10']);
        Eventlevels::create(['id' => 2, 'level' => 'Squadron Mandatory', 'points_rank' => '20']);
        Eventlevels::create(['id' => 3, 'level' => 'Wing Optional', 'points_rank' => '20']);
        Eventlevels::create(['id' => 4, 'level' => 'Wing Mandatory', 'points_rank' => '30']);
        Eventlevels::create(['id' => 5, 'level' => 'Group Optional', 'points_rank' => '30']);
        Eventlevels::create(['id' => 6, 'level' => 'Group Mandatory', 'points_rank' => '40']);
        Eventlevels::create(['id' => 7, 'level' => 'Federal Optional', 'points_rank' => '40']);
        Eventlevels::create(['id' => 8, 'level' => 'Federal Mandatory', 'points_rank' => '50']);
    }
}
