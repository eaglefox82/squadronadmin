<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Member;
use App\Settings;
use App\TermMapping;
use App\TermFees;


class TermFeesController extends Controller
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
        return view('termfees.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Insert into Mapping Table
        $e = new TermMapping;
        $e->year = Carbon::now()->year;
        $e->term = $request->input('term');
        $e->amount = Settings::where('setting', 'Term Fee Value')->get('value');

        //Create Term Fee Status
        $termid = TermMapping::latest()->value('id');

        $members = Member::where('active', 'Y')->where('member_type', 'League')->where('termfees', 'Y')->orderBy('rank','asc')->get();

        foreach ($members as $member) {
            $f = new TermFees;
            $f->member_id = $member->id;
            $f->term_id = $termid;
            $f->status = 'Pending';
            $f->save();
        }

        alear()->success('Term Fees Created Successfully')->autoclose(1500);
        return redirect(action('HomeControler@index'));
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
