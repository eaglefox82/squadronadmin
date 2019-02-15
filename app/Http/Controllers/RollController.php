<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Member;
use App\Roll;
use App\Rollmapping;
use App\RollStatus;

class RollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    $currentroll = DB::table('roll')
                    ->join('rollmapping', 'roll.roll_id' , '=', 'rollmapping.id' )
                    ->join('members', 'members.id', '=', 'roll.member_id')
                    ->Select('members.*', 'roll.status')
                    ->orderby ('rank', 'desc')
                    ->get();


        return view('roll.index', compact('currentroll'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('roll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $validateData = Validator::make($request->all(),[
            'rolldate' => 'required|date'
        ]);

        if ($validateData ->fails())
        {
            return Redirect::back()->withErrors($validateData)->withInput();
        }

        //Create Rollmapping
        $e = new Rollmapping();
        $e->roll_date = $request->get('rolldate');
        $e->save();

        //create Roll
        $rollid = Rollmapping::latest()->value('id');

        $roll = DB::table('members')
	   ->Select('id')
	   ->get();
       
            foreach ($roll as $r)
	        DB::table('roll')->insertGetId(
		        ['member_id' => $r, 'roll_id' => $rollid, 'status' => 'A']
            );
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
