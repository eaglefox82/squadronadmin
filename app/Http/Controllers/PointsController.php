<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Points;
use App\Pointsmaster;
use App\Member;
use Alert;

class PointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $year =  Carbon::parse(Carbon::now())->year;


        $pointrank = Points::query()
            ->select('member_id')->selectRaw('SUM(value) as TotalPoints')
            ->where('Year','=', $year)
            ->groupBy('member_id')
            ->orderByDesc('Totalpoints')
            ->get();

            return view ('report.points', compact('pointrank'));
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
        $e = new Pointsmaster();
        $e->reason = $request->get('reason');
        $e->value = $request->get('value');
        $e->save();

        alert()->Success('New Point Value Added')->autoclose(2000);
        return redirect(action('SettingsController@index'));
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

    public function addtomember(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'amount' => 'required'
        ]);
        if ($validateData->fails() )
            {
            return Redirect::back()->WithErrors($validateData) ->withInput();
            }

            $item = Pointsmaster::where('id', $request->get('item'))->value('reason');

            $e = new Points();
            $e->member_id = $request->get('member');
            $e->value = $request->get('amount');
            $e->reason = $item;
            $e->year = Carbon::parse(now())->year;
            $e->save();

            Alert()->success('Success', 'Account has been updated')->autoclose(1500);

            return redirect(action('MembersController@show', $request->get('member')));
    }


    public function getPoints($id = 0)
    {
        $data = Pointsmaster::where('id', $id)->first();
        return response()->json($data);
    }
}
