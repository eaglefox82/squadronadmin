<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Alert;


use App\Roll;
use App\Srequest;
use App\RequestItem;
use App\RequestPayment;
use App\RollMapping;
use App\Member;
use Carbon\Carbon;
use App\Settings;
use App\Accounts;
use App\Vouchers;

class SquadronAccountingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subfee = Settings::where('setting', '=', 'Weekly Fees')->value('value');

        $rollid = RollMapping::latest()->value('id');
        $outstanding = Roll::where('status', '=', 'P')->count();
        $requestsinvoice = Srequest::where('complete', '=', 'N')->sum('invoice_total');
        $requestPayments = RequestPayment::whereHas('request', function ($query) {
            $query->where('complete', '=', 'N');
        })
            ->sum('amount');

        $requestbalance = $requestsinvoice - $requestPayments;

        $totalsubs = Roll::where('status', '=', 'C')->where('paidrollid', '=', $rollid)->count() * $subfee;


        $members = Member::where('active', '!=', 'N')->where('member_type', '=', 'League')->get();


        $accountbalance = Accounts::sum('amount');

        $annualfee = Settings::where('setting', 'annual subs')->value('value');

        $attendance = Roll::where ('status', '!=', 'A')->where('roll_id', '=', $rollid)->count();

        $grouplevies = Settings::where('setting','=', 'Group Fees')->value('value') * $attendance;
        $winglevies = Settings::where('setting', '=', 'Wing Fees')->value('value') * $attendance;
        $annualsubs = Settings::where('setting', '=', 'Annual Sub Allocation')->value('value')* $attendance;
        $rent = Settings::where('setting', '=', 'Weekly Rent')->value('value');
        $pendingvouchers = (Vouchers::where('status','!=', 'C')->count())*100;


        $totalcost = $grouplevies + $winglevies + $annualsubs + $rent;
        $totalincome = $attendance * $subfee;
        $difference = $totalincome - $totalcost;


        return view('accounting.index', compact('accountbalance', 'outstanding', 'requestbalance', 'pendingvouchers', 'members', 'rollid', 'totalsubs', 'accountbalance', 'annualfee', 'totalcost', 'totalincome', 'difference'));


    }

    public function annualsubs()
    {
        $members = Member::where('active', '!=', 'N')->where('member_type', '=', 'League')->get();
        return view('accounting.annualsubs', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('accounting.add');
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

        if ($validateData->fails()) {
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

        Alert()->Success('New Requested Added', 'New Stock Request has been added')->autoclose(2000);
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
        $request = Srequest::find($id);

        $payments = Requestpayment::where('request_id', '=', $id)->get();

        return view('accounting.show', compact('request', 'payments'));
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
        $update = Srequest::find($id);
        $update->invoice_number = $request->get('invoice');
        $update->invoice_total = $request->get('amount');
        $update->save();

        Alert::success('Invoice Updated', 'Member Request details have been updated')->autoclose(1500);
        return redirect(action('SquadronAccountingController@show', $request->get('id')));
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

    public function payment(Request $request)
    {
        $rollid = Rollmapping::latest()->value('id');

        $e = new Requestpayment();
        $e->request_id = $request->get('id');
        $e->roll_id = $rollid;
        $e->amount = $request->get('amount');
        $e->save();

        Alert::Success('Payement Recored')->autoclose(2000);

        $id = $request->get('id');

        $invoice = Srequest::where('id', '=', $id)->value('invoice_total');
        $payments = RequestPayment::where('request_id', "=", $id)->sum('amount');

        $balance = $invoice - $payments;

        if ($balance > 0) {
            return redirect(action('SquadronAccountingController@requested'));
        } else {
            $e = Srequest::find($id);
            $e->complete = "Y";
            $e->save();

            Alert::Success('Invoice Completed')->autoclose(2000);
            return redirect(action('SquadronAccountingController@requested'));
        }
    }

    public function accountpayment(Request $request)
    {
        $rollid = RollMapping::latest()->value('id');
        $member = Srequest::where('id', "=", $request->get('id'))->value('member_id');

        $abalance = Accounts::where('member_id', "=", $member)->sum('amount');


        if ($abalance > 0) {
            if ($abalance >= $request->get('amount')) {
                $e = new RequestPayment();
                $e->request_id = $request->get('id');
                $e->roll_id = $rollid;
                $e->amount = $request->get('amount');
                $e->save();

                $e = new Accounts();
                $e->member_id = $member;
                $e->amount = $request->get('amount') * -1;
                $e->reason = "Invoice Payment";
                $e->save();

                Alert::Success('Payement Recored')->autoclose(2000);

                $id = $request->get('id');

                $invoice = Srequest::where('id', '=', $id)->value('invoice_total');
                $payments = RequestPayment::where('request_id', "=", $id)->sum('amount');

                $balance = $invoice - $payments;

                if ($balance > 0) {
                    return redirect(action('SquadronAccountingController@show', $request->get('id')));
                } else {
                    $e = Srequest::find($id);
                    $e->complete = "Y";
                    $e->save();

                    Alert::Success('Invoice Completed')->autoclose(2000);
                    return redirect(action('SquadronAccountingController@requested'));
                }
            } else {
                Alert::error("Error", "Insufficient Account Balance")->autoclose(1500);
                return redirect(action('SquadronAccountingController@show', $request->get('id')));
            }
        } else {
            Alert::error("Error", "Insufficient Account Balance")->autoclose(1500);
            return redirect(action('SquadronAccountingController@show', $request->get('id')));
        }
    }

}
