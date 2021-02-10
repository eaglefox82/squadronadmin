<?php

use Illuminate\Database\Seeder;
use App\Rankmapping;

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

        Rankmapping::truncate();

        Rankmapping::create(['id' => 1, 'rank' => 'Cheif Commissioner']);
        Rankmapping::create(['id' => 2, 'rank' => 'Commissioner']);
        Rankmapping::create(['id' => 3, 'rank' => 'Lieutenant Commissioner']);
        Rankmapping::create(['id' => 4, 'rank' => 'Group Commissioner']);
        Rankmapping::create(['id' => 5, 'rank' => 'Group Lieutenant']);
        Rankmapping::create(['id' => 6, 'rank' => 'Wing Captain']);
        Rankmapping::create(['id' => 7, 'rank' => 'Squadron Captain']);
        Rankmapping::create(['id' => 8, 'rank' => 'Squadron Lieutenant']);
        Rankmapping::create(['id' => 9, 'rank' => '1st Officer']);
        Rankmapping::create(['id' => 10, 'rank' => '2nd Officer']);
        Rankmapping::create(['id' => 12, 'rank' => 'Traniee Officer']);
        Rankmapping::create(['id' => 13, 'rank' => 'Warrant Officer']);
        Rankmapping::create(['id' => 14, 'rank' => 'Squadron Sergeant']);
        Rankmapping::create(['id' => 15, 'rank' => 'Drum Major']);
        Rankmapping::create(['id' => 16, 'rank' => 'Sergeant']);
        Rankmapping::create(['id' => 17, 'rank' => 'Corporal']);
        Rankmapping::create(['id' => 18, 'rank' => 'Leading Cadet']);
        Rankmapping::create(['id' => 19, 'rank' => 'Senior Cadet']);
        Rankmapping::create(['id' => 20, 'rank' => 'Cadet']);
        Rankmapping::create(['id' => 21, 'rank' => 'Junior Cadet']);


    }
}
