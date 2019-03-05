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
        //

        Member::truncate();

        Member::create(['id' => 1, 'membership_number' => 'N8185', 'first_name' => 'Raymond', 'last_name' => 'Bell', 'rank' => '2', 'date_joined' => '1944-11-15', 'date_birth' => '1932-05-05', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 2, 'membership_number' => 'N18094', 'first_name' => 'Brendan', 'last_name' => 'Fox', 'rank' => '4', 'date_joined' => '1996-05-10', 'date_birth' => '1982-07-02', 'active' => 'Y','member_type' => 'League' ]);  
        Member::create(['id' => 3, 'membership_number' => 'N21432', 'first_name' => 'Lachlan', 'last_name' => 'Hyde', 'rank' => '14', 'date_joined' => '2009-04-17', 'date_birth' => '2001-03-17', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 4, 'membership_number' => 'N21562', 'first_name' => 'Francisco', 'last_name' => 'Trostel', 'rank' => '10', 'date_joined' => '2010-02-26', 'date_birth' => '1998-11-12', 'active' => 'Y','member_type' => 'Associate' ]);
        Member::create(['id' => 5, 'membership_number' => 'N221609', 'first_name' => 'Patrick', 'last_name' => 'Estasy', 'rank' => '16', 'date_joined' => '2010-05-07', 'date_birth' => '2001-03-17', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 6, 'membership_number' => 'N21612', 'first_name' => 'Thomas', 'last_name' => 'Sterrett', 'rank' => '13', 'date_joined' => '2010-05-07', 'date_birth' => '2000-06-09', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 7, 'membership_number' => 'N21680', 'first_name' => 'Harrison', 'last_name' => 'Taranec', 'rank' => '10', 'date_joined' => '2010-06-18', 'date_birth' => '1998-05-19', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 8, 'membership_number' => 'N21785', 'first_name' => 'Karam', 'last_name' => 'Mandwie', 'rank' => '10', 'date_joined' => '2010-10-22', 'date_birth' => '1997-02-19', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 9, 'membership_number' => 'N21800', 'first_name' => 'Andrew', 'last_name' => 'Passmore', 'rank' => '17', 'date_joined' => '2011-02-04', 'date_birth' => '2002-06-26', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 10, 'membership_number' => 'N21948', 'first_name' => 'Stavros', 'last_name' => 'Skarmoutsos', 'rank' => '10', 'date_joined' => '2011-09-19', 'date_birth' => '1997-08-13', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 11, 'membership_number' => 'N22060', 'first_name' => 'Luke', 'last_name' => 'Passmore', 'rank' => '17', 'date_joined' => '2012-04-27', 'date_birth' => '2004-04-02', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 12, 'membership_number' => 'N22222', 'first_name' => 'Carlos', 'last_name' => 'Munoz', 'rank' => '10', 'date_joined' => '2012-11-30', 'date_birth' => '1998-03-15', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 13, 'membership_number' => 'N22235', 'first_name' => 'Tristan', 'last_name' => 'Sauer', 'rank' => '17', 'date_joined' => '2013-02-08', 'date_birth' => '2002-01-04', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 14, 'membership_number' => 'N22271', 'first_name' => 'Mitchell', 'last_name' => 'Hyde', 'rank' => '18', 'date_joined' => '2013-02-22', 'date_birth' => '2004-12-02', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 15, 'membership_number' => 'N22340', 'first_name' => 'Martin', 'last_name' => 'Sauer', 'rank' => '8', 'date_joined' => '2013-06-14', 'date_birth' => '1969-11-21', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 16, 'membership_number' => 'N22366', 'first_name' => 'Jaedenn', 'last_name' => 'Hidalgo', 'rank' => '17', 'date_joined' => '2013-07-19', 'date_birth' => '2003-09-02', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 17, 'membership_number' => 'N22380', 'first_name' => 'Benedict', 'last_name' => 'Evans', 'rank' => '18', 'date_joined' => '2013-08-16', 'date_birth' => '2003-01-10', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 18, 'membership_number' => 'N22459', 'first_name' => 'Brendan', 'last_name' => 'Mayorga', 'rank' => '18', 'date_joined' => '2014-02-14', 'date_birth' => '2006-03-12', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 19, 'membership_number' => 'N22460', 'first_name' => 'Jonathon', 'last_name' => 'Mayorga', 'rank' => '16', 'date_joined' => '2014-02-14', 'date_birth' => '2003-06-17', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 20, 'membership_number' => 'N22461', 'first_name' => 'Alex', 'last_name' => 'Munoz', 'rank' => '16', 'date_joined' => '2014-03-06', 'date_birth' => '2001-03-08', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 21, 'membership_number' => 'N22462', 'first_name' => 'Suchet', 'last_name' => 'Pun', 'rank' => '18', 'date_joined' => '2014-02-14', 'date_birth' => '2003-11-06', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 22, 'membership_number' => 'N22463', 'first_name' => 'Sakash', 'last_name' => 'Pun', 'rank' => '18', 'date_joined' => '2014-02-14', 'date_birth' => '2005-01-09', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 23, 'membership_number' => 'N22510', 'first_name' => 'Nathaniel', 'last_name' => 'Balderrama', 'rank' => '18', 'date_joined' => '2014-05-03', 'date_birth' => '2004-04-16', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 24, 'membership_number' => 'N22534', 'first_name' => 'Julian', 'last_name' => 'Evans', 'rank' => '19', 'date_joined' => '2014-05-23', 'date_birth' => '2006-05-27', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 25, 'membership_number' => 'N22587', 'first_name' => 'Arjun', 'last_name' => 'Jogia', 'rank' => '17', 'date_joined' => '2014-08-01', 'date_birth' => '2000-11-23', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 26, 'membership_number' => 'N22717', 'first_name' => 'Kevin', 'last_name' => 'Duan', 'rank' => '19', 'date_joined' => '2015-04-24', 'date_birth' => '2007-03-23', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 27, 'membership_number' => 'N22718', 'first_name' => 'James', 'last_name' => 'Fan', 'rank' => '19', 'date_joined' => '2015-04-24', 'date_birth' => '2006-03-05', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 28, 'membership_number' => 'N22719', 'first_name' => 'Ryan', 'last_name' => 'Homles', 'rank' => '18', 'date_joined' => '2015-04-17', 'date_birth' => '2007-06-14', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 29, 'membership_number' => 'N22787', 'first_name' => 'Tran', 'last_name' => 'Noah', 'rank' => '17', 'date_joined' => '2015-08-01', 'date_birth' => '2005-08-27', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 30, 'membership_number' => 'N22827', 'first_name' => 'Daniel', 'last_name' => 'Munoz', 'rank' => '18', 'date_joined' => '2015-09-19', 'date_birth' => '2002-09-16', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 31, 'membership_number' => 'N22945', 'first_name' => 'Sean Bao T', 'last_name' => 'Dang', 'rank' => '19', 'date_joined' => '2016-05-01', 'date_birth' => '2005-05-22', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 32, 'membership_number' => 'N22946', 'first_name' => 'Bandyn', 'last_name' => 'Pereira', 'rank' => '19', 'date_joined' => '2016-05-01', 'date_birth' => '2007-04-04', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 33, 'membership_number' => 'N22988', 'first_name' => 'Marcus', 'last_name' => 'Disibio', 'rank' => '19', 'date_joined' => '2016-08-05', 'date_birth' => '2005-06-14', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 34, 'membership_number' => 'N23017', 'first_name' => 'George', 'last_name' => 'Lloyd', 'rank' => '19', 'date_joined' => '2016-11-11', 'date_birth' => '2006-04-24', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 35, 'membership_number' => 'N23018', 'first_name' => 'Zaccary', 'last_name' => 'Lancaster', 'rank' => '18', 'date_joined' => '2016-11-04', 'date_birth' => '2004-08-30', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 36, 'membership_number' => 'N23077', 'first_name' => 'Charles', 'last_name' => 'Johnston', 'rank' => '19', 'date_joined' => '2017-02-03', 'date_birth' => '2006-03-26', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 37, 'membership_number' => 'N23092', 'first_name' => 'Nabeel', 'last_name' => 'Hussein', 'rank' => '19', 'date_joined' => '2017-05-05', 'date_birth' => '2006-11-06', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 38, 'membership_number' => 'N23093', 'first_name' => 'William', 'last_name' => 'Russell', 'rank' => '19', 'date_joined' => '2017-04-28', 'date_birth' => '2005-05-27', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 39, 'membership_number' => 'N23160', 'first_name' => 'Nicholas', 'last_name' => 'Hyde', 'rank' => '19', 'date_joined' => '2017-10-27', 'date_birth' => '2009-07-18', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 40, 'membership_number' => 'N23185', 'first_name' => 'Thomas', 'last_name' => 'Pham', 'rank' => '19', 'date_joined' => '2017-10-27', 'date_birth' => '2005-06-12', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 41, 'membership_number' => 'N23186', 'first_name' => 'Cleon', 'last_name' => 'Tran', 'rank' => '19', 'date_joined' => '2017-10-13', 'date_birth' => '2009-09-23', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 42, 'membership_number' => 'N23264', 'first_name' => 'Yash', 'last_name' => 'Alghare', 'rank' => '19', 'date_joined' => '2018-03-16', 'date_birth' => '2006-05-09', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 43, 'membership_number' => 'N23266', 'first_name' => 'Emilio', 'last_name' => 'Munoz', 'rank' => '19', 'date_joined' => '2018-05-04', 'date_birth' => '2010-04-28', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 44, 'membership_number' => 'N23267', 'first_name' => 'Visnuteia', 'last_name' => 'Parimkayala', 'rank' => '19', 'date_joined' => '2018-02-16', 'date_birth' => '2004-12-25', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 45, 'membership_number' => 'N23321', 'first_name' => 'Rimon', 'last_name' => 'Jwar', 'rank' => '19', 'date_joined' => '2018-08-03', 'date_birth' => '2009-04-09', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 46, 'membership_number' => 'N23322', 'first_name' => 'Joshua', 'last_name' => 'Mao', 'rank' => '19', 'date_joined' => '2018-08-03', 'date_birth' => '2010-05-09', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 47, 'membership_number' => 'N23323', 'first_name' => 'Duc', 'last_name' => 'Phan', 'rank' => '19', 'date_joined' => '2018-08-10', 'date_birth' => '2002-11-02', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 48, 'membership_number' => 'N23353', 'first_name' => 'Nihaar', 'last_name' => 'Pillai', 'rank' => '19', 'date_joined' => '2018-10-18', 'date_birth' => '2007-08-21', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 49, 'membership_number' => 'N23359', 'first_name' => 'Jack', 'last_name' => 'Anderson', 'rank' => '19', 'date_joined' => '2018-11-16', 'date_birth' => '2008-08-08', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 50, 'membership_number' => 'N23360', 'first_name' => 'Christopher', 'last_name' => 'Hosford', 'rank' => '19', 'date_joined' => '2018-11-16', 'date_birth' => '2003-04-08', 'active' => 'Y','member_type' => 'League' ]);
        Member::create(['id' => 51, 'membership_number' => 'N23361', 'first_name' => 'Aydan', 'last_name' => 'Kaya', 'rank' => '19', 'date_joined' => '2018-11-02', 'date_birth' => '2007-03-26', 'active' => 'Y','member_type' => 'League' ]);
    }
}
