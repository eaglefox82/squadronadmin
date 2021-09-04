<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Vouchers;
use App\Accounts;
use App\Member;
use Alert;

class ActiveKidsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vouchers = Vouchers::where('status', '!=', 'C')->get();

        return view('active.show', compact('vouchers'));
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

     public function voucher($id)
    {
        //
        $member = Member::find($id);

        return view('members.voucher', compact('member'));
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
            'voucher'=> 'required',
        ]);
        if ($validateData->fails() )
            {
            return Redirect::back()->WithErrors($validateData) ->withInput();
            }

            $e = new Vouchers();
            $e->member_id = $request->get('member');
            $e->voucher_number = $request->get('voucher');
            $e->voucher_type = $request->get('type');
            $e->status = "E";
            $e->save();

            $e = new Accounts();
            $e->member_id = $request->get('member');
            $e->amount = $request->get('balance');
            $e->reason = "Voucher Top Up";
            $e->user = Auth::user()->username;
            $e->save();

            Alert()->success('Success', 'Voucher has been recored')->autoclose(1500);

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
        $voucher = Vouchers::find($id);

        if ($voucher != null)
        {
            return view('active.edit', compact('voucher'));
        }
        return redirect(action('ActiveKidsController@index'));
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

    public function complete($id)
    {
        $v = Vouchers::find($id);

        if ($v != null)
            {
                $v->Status = 'C';
                $v->save();
                Alert()->success('Success', 'Voucher has been marked as completed and removed from list')->autoclose(1500);
                return redirect(action('ActiveKidsController@index'));
            }
            return redirect(action('ActiveKidsControler@index'));

    }

    public function submit($id)
    {
        $v = Vouchers::find($id);

        if ($v != null)
        {
            $v->Status = 'S';
            $v->save();
            Alert()->success('Success', 'Voucher has been marked as Submitted')->autoclose(1500);
            return redirect(action('ActiveKidsController@index'));
        }
        return redirect(action('ActiveKidsControler@index'));
    }


        public function bankingreference(Request $request, $id)
        {
            $v = Vouchers::find($id);

            if ($v != null)
            {
                $v->banking_reference = $request-> get('banking_reference');
                $v->save();

                alert()->success('Success', 'Banking Reference has been added')->autoclose(1500);
                return redirect(action('ActiveKidsController@index'));
            }
            return redirect(action('ActiveKidsController@index'));
        }
}
