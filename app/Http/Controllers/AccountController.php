<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Member;
use App\Accounts;
use Alert;
use App\Otheritemmapping;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'amount' => 'required'
        ]);
        if ($validateData->fails() )
            {
            return Redirect::back()->WithErrors($validateData) ->withInput();
            }

            $e = new Accounts();
            $e->member_id = $request->get('member');
            $e->amount = $request->get('amount');
            $e->reason = "Account Top Up";
            $e->user = Auth::user()->username;
            $e->save();

            Alert()->success('Success', 'Account has been updated')->autoclose(1500);

            return redirect(action('MembersController@show', $request->get('member')));

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

    public function item(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'amount' => 'required'
        ]);
        if ($validateData->fails() )
            {
            return Redirect::back()->WithErrors($validateData) ->withInput();
            }


            if($request->get('amount') <= Accounts::where('member_id', '=', $request->get('member'))->sum('amount'))
            {
                $item = Otheritemmapping::where('id', $request->get('item'))->value('item');

                $e = new Accounts();
                $e->member_id = $request->get('member');
                $e->amount = $request->get('amount')*-1;
                $e->reason = "Payment for ".$item;
                $e->user = Auth::user()->username;
                $e->save();

                Alert()->success('Success', 'Account has been updated')->autoclose(1500);

                return redirect(action('MembersController@show', $request->get('member')));
            }

            alert()->error('Fail', 'Account balance is too small for this transaction')->autoclose(1500);

            return redirect(action('MembersController@show', $request->get('member')));
    }
}
