<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Rollmapping;
use App\Roll;
use App\Members;

class Form19Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

        $rollmonth = Rollmapping::latest()->value('roll_month');
        
        $officerwk1 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->where('members.rank', '<', 12)
            ->where('rollmapping.roll_week', '=', 1)
            ->get();

        $officerwk2 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->where('members.rank', '<', 12)
            ->where('rollmapping.roll_week', '=', 2)
            ->get();

        $officerwk3 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->where('members.rank', '<', 12)
            ->where('rollmapping.roll_week', '=', 3)
            ->get();

        $officerwk4 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->where('members.rank', '<', 12)
            ->where('rollmapping.roll_week', '=', 4)
            ->get();

        $officerwk5 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->where('members.rank', '<', 12)
            ->where('rollmapping.roll_week', '=', 5)
            ->get();

        $towk1 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->wherebetween('members.rank', [12,13])
            ->where('rollmapping.roll_week', '=', 1)
            ->get();

        $towk2 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->wherebetween('members.rank', [12,13])
            ->where('rollmapping.roll_week', '=', 2)
            ->get();

        $towk3 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->wherebetween('members.rank', [12,13])
            ->where('rollmapping.roll_week', '=', 3)
            ->get();

        $towk4 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->wherebetween('members.rank', [12,13])
            ->where('rollmapping.roll_week', '=', 4)
            ->get();

        $towk5 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->wherebetween('members.rank', [12,13])
            ->where('rollmapping.roll_week', '=', 5)
            ->get();

        $ncowk1 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->wherebetween('members.rank', [14,18])
            ->where('rollmapping.roll_week', '=', 1)
            ->get();

        $ncowk2 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->wherebetween('members.rank', [14,18])
            ->where('rollmapping.roll_week', '=', 2)
            ->get();

        $ncowk3 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->wherebetween('members.rank', [14,18])
            ->where('rollmapping.roll_week', '=', 3)
            ->get();

        $ncowk4 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->wherebetween('members.rank', [14,18])
            ->where('rollmapping.roll_week', '=', 4)
            ->get();

        $ncowk5 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->wherebetween('members.rank', [14,18])
            ->where('rollmapping.roll_week', '=', 5)
            ->get();
        
        $cadetwk1 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->where('members.rank', '>', 18)
            ->where('rollmapping.roll_week', '=', 1)
            ->get();

        $cadetwk2 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->where('members.rank', '>', 18)
            ->where('rollmapping.roll_week', '=', 2)
            ->get();

        $cadetwk3 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->where('members.rank', '>', 18)
            ->where('rollmapping.roll_week', '=', 3)
            ->get();

        $cadetwk4 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->where('members.rank', '>', 18)
            ->where('rollmapping.roll_week', '=', 4)
            ->get();

        $cadetwk5 = DB::table('roll')
            ->join('rollmapping', "roll.roll_id", "=", "rollmapping.id")
            ->join('members', 'roll.member_id', '=', 'members.id')
            ->where('rollmapping.roll_month','=', $rollmonth)
            ->where('roll.status', '!=', 'A')
            ->where('members.rank', '>', 18)
            ->where('rollmapping.roll_week', '=', 5)
            ->get();
        
    return view('form19.index', compact('officerwk1', 'officerwk2', 'officerwk3','officerwk4','officerwk5', 'towk1', 'towk2', 'towk3', 'towk4', 'towk5', 'ncowk1', 'ncowk2', 'ncowk3', 'ncowk4', 'ncowk5', 'cadetwk1', 'cadetwk2', 'cadetwk3', 'cadetwk4', 'cadetwk5'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
