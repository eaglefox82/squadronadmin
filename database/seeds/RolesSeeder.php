<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::truncate();

        Role::create(['id' => 1, 'name' => 'Admin', 'description' => 'System Administrator']);
        Role::create(['id' => 2, 'name' => 'Staff', 'description' => 'Squadron Staff']);
        Role::create(['id' => 3, 'name' => 'User', 'description' => 'General User']);
    }
}
