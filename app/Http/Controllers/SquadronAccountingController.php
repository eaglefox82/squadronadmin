<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Alert;


use App\roll;
use App\Srequest;
use App\requestitem;
use App\Requestpayment;
use App\rollmapping;
use App\member;
use Carbon\Carbon;

class SquadronAccountingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $outstanding = Roll::where('status', '=', 'P')->count();
    $requestsinvoice = Srequest::where('complete', '=', 'N')->sum('invoice_total');
    $requestPayments = Requestpayment::whereHas('request', function ($query) {
        $query->where('complete', '=', 'N');
    })
    ->sum('amount');

    $requestbalance = $requestsinvoice - $requestPayments;


    $members = Member::where('active', '!=', 'N')->where('member_type', '=', 'League')->get();

        return view('accounting.index', compact('outstanding', 'requestbalance', 'members', 'rollid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view ('accounting.add');
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
        $validateData  = Validator::make($request->all(), [
            'membership' => 'required',
            'overview' => 'required',
        ]);

        if ($validateData->fails())
        {
            return Redirect::back()->withErrors($validateData)->withInput();
        }



           $e = new Srequest();
           $e->member_id = $request->get('membership');
           $e->overview = $request->get('overview');
           $e->invoice_number = $request->get('Invoice');
           $e->invoice_total = $request->get('total');
           $e->requested_date = Carbon::now();
           $e->notes = $request->get('notes');
           $e->complete = 'N';
           $e->save();

           Alert::Success('New Requested Added', 'New Stock Request has been added')->autoclose(2000);
           return redirect(action('SquadronAccountingController@requested'));
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

    public function outstanding()
    {
        $outstandingSubs = Member::where('active', '!=', 'N')->where('member_type', '=', 'League')->get();

        return view('accounting.outstanding', compact('outstandingSubs'));
    }

    public function requested()
    {
        $Srequest = Srequest::where('complete', '=', 'N')->get();
        $members = Member::where('active', '!=', 'N')->where('member_type', '=', 'League')->get();

        return view('accounting.requestview', compact('Srequest', 'members'));
    }

   public function payment($id)
   {




    Alert::Success('Payement Recored')->autoclose(2000);
    return redirect(action('SquadronAccountingController@requested'));
   }
}
