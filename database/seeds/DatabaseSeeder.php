<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(MemberSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(RankmappingSeeder::class);
        $this->call(RollstatusSeeder::class);
        $this->call(VoucherstatusSeeder::class);
        $this->call(VouchertypeSeeder::class);
        $this->call(FlightSeeder::class);
        $this->call(PointsmasterSeeder::class);
        $this->call(EventlevelSeeder::class);

    }
}
