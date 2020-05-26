<?php

use Illuminate\Database\Seeder;

use App\Flight;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Flight::truncate();

        Flight::create(['id' => 1, 'Flight_name' => 'Officers']);
        Flight::create(['id' => 2, 'Flight_name' => 'Flag Party']);
        Flight::create(['id' => 3, 'Flight_name' => 'Flight A']);
        Flight::create(['id' => 4, 'Flight_name' => 'Flight B']);
        Flight::create(['id' => 5, 'Flight_name' => 'Flight C']);
        Flight::create(['id' => 6, 'Flight_name' => 'Flight D']);
        Flight::create(['id' => 7, 'Flight_name' => 'Flight E']);
        Flight::create(['id' => 8, 'Flight_name' => 'Band A']);
        Flight::create(['id' => 9, 'Flight_name' => 'Band B']);
    }
}
