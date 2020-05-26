<?php

use Illuminate\Database\Seeder;
use App\Vouchertype;

class VouchertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Vouchertype::truncate();
        Vouchertype::create(['id'=>1, 'voucher_code' => 'A', 'voucher_type' => 'Active Kids']);
        Vouchertype::create(['id'=>2, 'voucher_code' => 'C', 'voucher_type' => 'Creative Kids']);

    }
}
