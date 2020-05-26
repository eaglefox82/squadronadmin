<?php

use Illuminate\Database\Seeder;
use App\Voucherstatus;

class VoucherstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Voucherstatus::truncate();

        Voucherstatus::create(['id' => 1, 'status_code' => 'E', 'desc' => 'Entered']);
        Voucherstatus::create(['id' => 2, 'status_code' => 'S', 'desc' => 'Submitted']);
        Voucherstatus::create(['id' => 3, 'status_code' => 'C', 'desc' => 'Completed']);
    }
}
