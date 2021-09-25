<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;

use App\RollMapping;
use App\Roll;
use App\Member;
use App\Settings;
use App\Completedform;

class Form19Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastRollMap = Rollmapping::latest()->first();

        $meetingnights = Rollmapping::where('roll_year', $lastRollMap->roll_year)->where('roll_month', $lastRollMap->roll_month)->count();


        $weeksinmonth = Rollmapping::latest()->value('roll_week');

        $monthlyRoll = Rollmapping::where('roll_year', $lastRollMap->roll_year)->where('roll_month', $lastRollMap->roll_month)->get(); //Added where clause to ensure the current year is selected - BF
        $nightsInMonth = 0;

        $startDate = Carbon::create($lastRollMap->roll_year, $lastRollMap->roll_month, 1);
        if ($startDate->dayOfWeek != Carbon::FRIDAY)
        {
            //Make sure the first day of the month isn't a friday
            $startDate = $startDate->next(Carbon::FRIDAY); // Get the first friday.
        }
        $endDate = $startDate->copy()->endOfMonth();

        for ($date = $startDate; $date->lte($endDate); $date->addWeek())
        {
            $nightsInMonth++;
        }

        $groupfee =Settings::where('setting', '=', 'Group Fees')->value('value');
        $subs =Settings::where('setting', '=', 'Weekly Fees')->value('value');
        $wing =Settings::where('setting', '=', 'wing Fees')->value('value');
        $newmembers = Member::Where('join_year','=', $lastRollMap->roll_year)->where('join_month','=', $lastRollMap->roll_month)->get();
        $totalmember = Member::Where('member_type', '=' , 'League')->where('active','=', 'Y')->get();

        return view('form19.index', compact('monthlyRoll', 'nightsInMonth', 'groupfee', 'subs', 'wing','weeksinmonth', 'meetingnights', 'newmembers', 'totalmember'));
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
        $generalreport = $request->get('report');
        return ('generalreport');
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


    public function printForm(Request $request)
    {
        $generalreport = $request->get('report');

        $lastRollMap = Rollmapping::latest()->first();
        $joinyear = Rollmapping::latest()->value('roll_year');
        $joinmonth = Rollmapping::latest()->value('roll_month');

        $month_name = date("F", mktime(0,0,0,$lastRollMap->roll_month,10));

        $meetingnights = Rollmapping::where('roll_year', $lastRollMap->roll_year)->where('roll_month', $lastRollMap->roll_month)->count();


        $weeksinmonth = Rollmapping::latest()->value('roll_week');

        $monthlyRoll = Rollmapping::where('roll_month', $lastRollMap->roll_month)->get();
        $nightsInMonth = 0;

        $startDate = Carbon::create($lastRollMap->roll_year, $lastRollMap->roll_month, 1);
        if ($startDate->dayOfWeek != Carbon::FRIDAY)
        {
            //Make sure the first day of the month isn't a friday
            $startDate = $startDate->next(Carbon::FRIDAY); // Get the first friday.
        }
        $endDate = $startDate->copy()->endOfMonth();

        for ($date = $startDate; $date->lte($endDate); $date->addWeek())
        {
            $nightsInMonth++;
        }

        $nightdate = $startDate; $date->lte($endDate); $date->addWeek();

        $groupfee =Settings::where('setting', '=', 'Group Fees')->value('value');
        $subs =Settings::where('setting', '=', 'Weekly Fees')->value('value');
        $wing =Settings::where('setting', '=', 'wing Fees')->value('value');




        $totalofficer = Member::Where('rank' ,'<=', 11)->Where('member_type', '=' , 'League')->where('active','=', 'Y')->count();
        $totalto = Member::WhereBetween('rank' , [12,13])->Where('member_type', '=' , 'League')->where('active','=', 'Y')->count();
        $totalnco = Member::WhereBetween('rank', [14,18])->Where('member_type', '=' , 'League')->where('active','=', 'Y')->count();
        $totalcadets = Member::Where('rank' ,'>', 18)->Where('member_type', '=' , 'League')->where('active','=', 'Y')->count();
        $totalmember = Member::Where('member_type', '=' , 'League')->where('active','=', 'Y')->count();
        $newmembers = Member::Where('join_year','=', $lastRollMap->roll_year)->where('join_month','=', $lastRollMap->roll_month)->get();

        $pdf = PDF::loadView('report.form19',  compact('generalreport','monthlyRoll', 'nightsInMonth', 'groupfee', 'subs', 'wing','weeksinmonth', 'meetingnights', 'lastRollMap', 'month_name', 'totalmember', 'totalcadets', 'totalnco', 'totalto', 'totalofficer', 'newmembers'));
        Storage::disk('completedforms')->put('Form 19 - '.$month_name . ' ' . $lastRollMap->roll_year.'.pdf', $pdf->output());

        $e = new Completedform();
        $e->form_name = 'Form 19 - '.$month_name . ' ' . $lastRollMap->roll_year.'.pdf';
        $e->month = date("F", mktime(0,0,0,$lastRollMap->roll_month,10));
        $e->year = $lastRollMap->roll_year;
        $e->type = 'Form 19';
        $e->save();

        return $pdf->download ('Form 19 - '.$month_name . ' ' . $lastRollMap->roll_year.'.pdf');

        return view('report.form19', compact('generalreport','monthlyRoll', 'nightsInMonth', 'groupfee', 'subs', 'wing','weeksinmonth', 'meetingnights', 'lastRollMap', 'month_name', 'totalmember', 'totalcadets', 'totalnco', 'totalto', 'totalofficer', 'newmembers'));
    }
}
