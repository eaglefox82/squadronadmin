<?php

use Illuminate\Database\Seeder;
use App\Rollstatus;

class RollstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Only seed if we don't have any records
        if (sizeof(Rollstatus::all()) > 0)
        {
            return;
        }

        Rollstatus::create(['id' => 1, 'status_id' => 'A', 'Status' => 'Away']);
        Rollstatus::create(['id' => 2, 'status_id' => 'C', 'Status' => 'Present/Paid']);
        Rollstatus::create(['id' => 3, 'status_id' => 'V', 'Status' => 'Present/Voucher']);
        Rollstatus::create(['id' => 4, 'status_id' => 'P', 'Status' => 'Present/Not Paid']);
    }
}
