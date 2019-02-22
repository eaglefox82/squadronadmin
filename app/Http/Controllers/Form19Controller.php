<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Rollmapping;

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


        $officers = DB::table('roll')
        ->join('rollmapping', 'roll.roll_id' , '=', 'rollmapping.id' )
        ->join('members', 'members.id', '=', 'roll.member_id')
        ->join('rankmappings', 'members.rank', '=', 'rankmappings.id' )
        ->join('rollstatus', 'roll.status', '=', 'status_id')
        ->Select('members.*', 'roll.roll_id', 'rankmappings.*', 'rollstatus.status', 'roll.status')
        ->where('roll.roll_month', '=', $rollmonth)
        ->where('roll.status', '!=', 'A')
        ->where('members.rank', '<', 12 )
        ->orderby ('rankmappings.id')
        ->get();


        $to = DB::table('roll')
        ->join('rollmapping', 'roll.roll_id' , '=', 'rollmapping.id' )
        ->join('members', 'members.id', '=', 'roll.member_id')
        ->join('rankmappings', 'members.rank', '=', 'rankmappings.id' )
        ->join('rollstatus', 'roll.status', '=', 'status_id')
        ->Select('members.*', 'roll.roll_id', 'rankmappings.*', 'rollstatus.status', 'roll.status')
        ->where('roll.roll_month', '=', $rollmonth)
        ->where('roll.status', '!=', 'A')
        ->whereBetween('members.rank', [12,13])
        ->orderby ('rankmappings.id')
        ->get();


        $nco = DB::table('roll')
        ->join('rollmapping', 'roll.roll_id' , '=', 'rollmapping.id' )
        ->join('members', 'members.id', '=', 'roll.member_id')
        ->join('rankmappings', 'members.rank', '=', 'rankmappings.id' )
        ->join('rollstatus', 'roll.status', '=', 'status_id')
        ->Select('members.*', 'roll.roll_id', 'rankmappings.*', 'rollstatus.status', 'roll.status')
        ->where('roll.roll_month', '=', $rollmonth)
        ->where('roll.status', '!=', 'A')
        ->whereBetween('members.rank', [14,18])
        ->orderby ('rankmappings.id')
        ->get();


        $cadet = DB::table('roll')
        ->join('rollmapping', 'roll.roll_id' , '=', 'rollmapping.id' )
        ->join('members', 'members.id', '=', 'roll.member_id')
        ->join('rankmappings', 'members.rank', '=', 'rankmappings.id' )
        ->join('rollstatus', 'roll.status', '=', 'status_id')
        ->Select('members.*', 'roll.roll_id', 'rankmappings.*', 'rollstatus.status', 'roll.status')
        ->where('roll.roll_month', '=', $rollmonth)
        ->where('roll.status', '!=', 'A')
        ->where('members.rank', '>', 18 )
        ->orderby ('rankmappings.id')
        ->get();

    return view('form19.index', compact ('officers', 'to', 'nco', 'cadet', 'rollweek'));
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
