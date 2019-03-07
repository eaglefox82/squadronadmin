<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Rollmapping;
use App\Roll;
use App\Members;
use App\Settings;

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

        $groupfee =Settings::where('setting', '=', 'Group Fees')->value('value');
        $subs =Settings::where('setting', '=', 'Weekly Fees')->value('value');
        $wing =Settings::where('setting', '=', 'wing Fees')->value('value');

        return view('form19.index', compact('monthlyRoll', 'nightsInMonth', 'groupfee', 'subs', 'wing','weeksinmonth'));
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
