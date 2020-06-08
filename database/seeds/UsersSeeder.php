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
        //Only seed if we don't have any records
        if (sizeof(User::all()) > 0)
        {
            return;
        }

		$admin = new User();
		$admin->firstname = "Brendan";
		$admin->lastname = "Fox";
		$admin->username = "b.fox";
		$admin->password = bcrypt('n18094');
		$admin->role_id = 1;
        $admin->save();

        $admin = new User();
		$admin->firstname = "Tim";
		$admin->lastname = "Larkin";
		$admin->username = "t.larkin";
		$admin->password = bcrypt('goblin');
		$admin->role_id = 1;
        $admin->save();
    }
}
