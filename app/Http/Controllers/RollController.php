<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Alert;

use App\Member;
use App\Roll;
use App\Rollmapping;
use App\RollStatus;
use App\ActiveKids;

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
        $rollid = Rollmapping::latest()->value('id');
        $rolldate = Rollmapping::latest()->value('roll_date');

        $member = Roll::where('roll_id','=', $rollid)->orderBy('status', 'asc')->orderby('member_id', 'asc')->get();

        return view('roll.index', compact('member', 'rolldate'));
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
            'rolldate' => 'required'
        ]);

        if ($validateData ->fails())
        {
            return Redirect::back()->withErrors($validateData)->withInput();
        }

        //Create Rollmapping
        $date = Carbon::parse($request->get('rolldate'))->format('Y-m-d');
        $e = new Rollmapping();
        $e->roll_date = Carbon::parse($request->get('rolldate'));
        $e->roll_year = Carbon::parse($date)->year;
        $e->roll_month = Carbon::parse($date)->month;
        $e->roll_week = Carbon::parse($date)->weekNumberInMonth;
        $e->save();

        //create Roll
        $rollid = Rollmapping::latest()->value('id');

        $members = Member::where('active', '=', 'Y')->Where('member_type', '=', 'League')->orderBy('rank','asc')->get();

            foreach ($members as $m)
            {
                $r=new Roll;
                $r->member_id = $m->id;
                $r->roll_id = $rollid;
                $r->Status = 'A';
                $r->save();
            }
        Alert::success('New Roll Created')->autoclose(1500);
       return redirect(action('RollController@index'));
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

    public function paid($id)
    {

        $r = Roll::find($id);

        if ($r != null)
        {
            $r->status = "C";
            $r->save();

            return redirect(action('RollController@index'))->with ('success', 'Member Paid');
        }

        return redirect(action('RollController@index'));
    }



    public function voucher($id)
    {
        $r = Roll::find($id);

        if ($r != null)
        {
            // Check if ActiveKids Balance is not less than 0
            if ($r->member->ActiveKids->sum('balance') >= 10)
            {
                // Update Roll Status
                $r->status = "V";
                $r->save();

                // Insert Record into ActiveKids Voucher
                $voucher = new ActiveKids();
                $voucher->member_id = $r->member_id;
                $voucher->voucher_number = 'Weekly Subs';
                $voucher->balance = -10;
                $voucher->date_received = Carbon::now()->toDateString();
                $voucher->save();

                return redirect(action('RollController@index'))->with ('success', 'Member Paid with Active Kids');
            }
            else
            {
                //Not Enough money in the account
                Alert::Error("Error", "Insufficient Active Kids Balance")->autoclose(1500);
                return redirect(action('RollController@index'));
            }
        }

        return redirect(action('RollController@index'));
    }

    public function notpaid($id)
    {
        $r = Roll::find($id);

        if ($r != null)
        {
            $r->status = "P";
            $r->save();

            return redirect(action('RollController@index'))->with ('success', 'Member Present');
        }

        return redirect(action('RollController@index'));
    }

    public function updateRoll($id)
    {
        $o = Roll::find($id);

        if ($o != null)
        {
            $o->status = "C";
            $o->save();

           return redirect(action('MembersController@show', $o->member_id))->with ('success', 'Member Present');
        }

        return redirect(action('MembersController@index'));
    }
}
