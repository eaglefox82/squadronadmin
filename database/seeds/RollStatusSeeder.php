<?php

use Illuminate\Database\Seeder;


class RollStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        RollStatus::truncate();

       $admin = new Settings();
       $admin->status_id = "M";
       $admin->status = "Subs Paid";
       $admin->save();

       $admin = new Settings();
       $admin->status_id = "P";
       $admin->status = "Present - Unpaid";
       $admin->save();
       
       $admin = new Settings();
       $admin->status_id = "A";
       $admin->status = "Not Present";
       $admin->save();
    
    }
}
