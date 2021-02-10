<?php

use Illuminate\Database\Seeder;

use App\Pointsmaster;

class PointsmasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Pointsmaster::truncate();

        Pointsmaster::create(['id' => 1, 'reason' => 'Attendance', 'value' => 10]);
        Pointsmaster::create(['id' => 2, 'reason' => 'Education Mark', 'Value' => 'Enter Result']);
    }
}
