<?php

namespace App\Http\Controllers;

use App\StaffAttendance;
use App\Member;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class StaffAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $officerlist = Member::where ('rank', '<', '14')->get();
        $pendingleave = StaffAttendance::where('date', '>=', Carbon::now())->orderby('date')->get();

        return (view('Report.staffleave', compact('officerlist', 'pendingleave')));
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
        $validateData = Validator::make($request->all(), [
            'member_id' => 'required',
            'date' => 'required',
        ]);

        if($validateData->fails()){
            return Redirect::back()->withErrors($validateData)->withInput();
        }

        $e = new StaffAttendance();
        $e->member_id = $request->input('member_id');
        $e->date = Carbon::parse($request->input('date'));
        $e->save();

        Alert()->success('Success', 'Leave Request Submitted')->autoclose(2000);
        return redirect(action('StaffAttendanceController@index'));
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
