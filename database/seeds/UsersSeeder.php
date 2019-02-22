<?php

use App\User;
use App\Member;
use App\Squadron;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
		$admin->firstname = "Brendan";
		$admin->lastname = "Fox";
		$admin->username = "b.fox";
		$admin->password = bcrypt('n18094');
		$admin->role_id = 1;
        $admin->save();
        

        $admin = new User();
        $admin->firstname = "Karam";
        $admin->lastname = "Mandwie";
        $admin->username = "k.mandwie";
        $admin->password = bcrypt('8825457');
        $admin->role_id = 1;
        $admin->save();
    }
}
