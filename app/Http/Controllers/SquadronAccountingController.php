<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


use App\roll;
use App\Srequest;
use App\requestitem;
use App\requestpayment;
use App\rollmapping;
use App\member;

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

        return view('accounting.index', compact('outstanding', 'requestbalance'));
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

    public function outstanding()
    {
        $outstandingSubs = Member::where('active', '!=', 'N')->where('member_type', '=', 'League')->get();

        return view('accounting.outstanding', compact('outstandingSubs'));
    }
}
