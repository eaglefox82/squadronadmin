<?php

use Illuminate\Database\Seeder;
use App\Settings;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Settings::truncate();

       $admin = new Settings();
       $admin->setting = "Weekly Fees";
       $admin->Value = "10";
       $admin->save();

       $admin = new Settings();
       $admin->setting = "Group Fees";
       $admin->Value = "2.5";
       $admin->save();

       $admin = new Settings();
       $admin->setting = "Wing Fees";
       $admin->Value = "0.15";
       $admin->save();

       $admin = new Settings();
       $admin->setting = "Attendance";
       $admin->Value = "80";
       $admin->save();

       $admin = new Settings();
       $admin->setting = "Annual Subs";
       $admin->Value = "55";
       $admin->save();
   }
}


