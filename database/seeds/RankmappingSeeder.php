<?php

use Illuminate\Database\Seeder;
use App\Rankmappings;

class RankmappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Rankmappings::truncate();

        Rankmappings::create(['id' => 1, 'rank' => 'Cheif Commissioner']);
        Rankmappings::create(['id' => 2, 'rank' => 'Commissioner']);
        Rankmappings::create(['id' => 3, 'rank' => 'Lieutenant Commissioner']);
        Rankmappings::create(['id' => 4, 'rank' => 'Group Commissioner']);
        Rankmappings::create(['id' => 5, 'rank' => 'Group Lieutenant']);
        Rankmappings::create(['id' => 6, 'rank' => 'Wing Captain']);
        Rankmappings::create(['id' => 7, 'rank' => 'Squadron Captain']);
        Rankmappings::create(['id' => 8, 'rank' => 'Squadron Lieutenant']);
        Rankmappings::create(['id' => 9, 'rank' => '1st Officer']);
        Rankmappings::create(['id' => 10, 'rank' => '2nd Officer']);
        Rankmappings::create(['id' => 12, 'rank' => 'Traniee Officer']);
        Rankmappings::create(['id' => 13, 'rank' => 'Warrant Officer']);
        Rankmappings::create(['id' => 14, 'rank' => 'Squadron Sergeant']);
        Rankmappings::create(['id' => 15, 'rank' => 'Drum Major']);
        Rankmappings::create(['id' => 16, 'rank' => 'Sergeant']);
        Rankmappings::create(['id' => 17, 'rank' => 'Corporal']);
        Rankmappings::create(['id' => 18, 'rank' => 'Leading Cadet']);
        Rankmappings::create(['id' => 19, 'rank' => 'Cadet']);
        Rankmappings::create(['id' => 20, 'rank' => 'Junior Cadet']);


    }
}
