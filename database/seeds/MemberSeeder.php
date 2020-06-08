<?php

use Illuminate\Database\Seeder;
use App\Member;

class MemberSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Only seed if we don't have any records
        if (sizeof(Member::all()) > 0)
        {
            return;
        }

        Member::create(['id' => 1, 'membership_number' => 'N18094', 'first_name' => 'Brendan', 'last_name' => 'Fox', 'rank' => '4', 'date_joined' => '1996-05-10', 'date_birth' => '1982-07-02', 'active' => 'Y','member_type' => 'League', 'Flight' => 1 ]);
        Member::create(['id' => 2, 'membership_number' => 'N21669', 'first_name' => 'Lachlan', 'last_name' => 'Abernethy', 'rank' => '10', 'date_joined' => '2010-06-18', 'date_birth' => '2000-02-09', 'active' => 'Y','member_type' => 'League', 'Flight' => 1 ]);
        Member::create(['id' => 3, 'membership_number' => 'N21562', 'first_name' => 'Jack', 'last_name' => 'Kelly', 'rank' => '10', 'date_joined' => '2013-01-03', 'date_birth' => '1999-05-09', 'active' => 'Y','member_type' => 'League', 'Flight' => 1 ]);
        Member::create(['id' => 4, 'membership_number' => 'N21609', 'first_name' => 'Patrick', 'last_name' => 'Estasy', 'rank' => '12', 'date_joined' => '2010-05-07', 'date_birth' => '2001-03-17', 'active' => 'Y','member_type' => 'League', 'Flight' => 1 ]);
        Member::create(['id' => 5, 'membership_number' => 'N21612', 'first_name' => 'Thomas', 'last_name' => 'Sterrett', 'rank' => '13', 'date_joined' => '2010-05-07', 'date_birth' => '2000-06-09', 'active' => 'Y','member_type' => 'League', 'Flight' => 1 ]);
        Member::create(['id' => 6, 'membership_number' => 'N22587', 'first_name' => 'Arjun', 'last_name' => 'Jogia', 'rank' => '12', 'date_joined' => '2014-08-01', 'date_birth' => '2000-11-23', 'active' => 'Y','member_type' => 'League', 'Flight' => 1 ]);

    }
}
