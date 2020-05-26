<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();

		$admin = new User();
		$admin->member_id = "b.fox";
		$admin->name = "Brendan Fox";
		$admin->email = "field.nsw@airleague.com.au";
		$admin->password = bcrypt('n18094');

        $admin->save();
    }
}
