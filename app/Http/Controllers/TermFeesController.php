<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;

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
        $id = TermMapping::latest()->value('id');
        $year = TermMapping::where('id', $id)->value('year');
        $term = TermMapping::where('id', $id)->value('term');

        $status = TermFees::where('term_id', $id)->get();


        return view('termfees.index_test', compact('year', 'term', 'status'));
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
        $e->start_date = Carbon::parse($request->get('date'));
        $e->save();

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

        alert()->success('Term Fees Created Successfully')->autoclose(1500);
        return redirect(action('TermFeesController@index'));
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
        $recordid = $id;
        $memberid = TermFees::where("id", $recordid)->value('member_id');
        $memberlast = Member::where('id', $memberid)->value('last_name');
        $memberfirst = Member::where('id', $memberid)->value('first_name');

        return view('termfees.payment', compact('recordid', 'memberlast', 'memberfirst'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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

    public function recordpayment(Request $request)
    {

        $id = TermFees::find($request->get('memberId'));
        $id->status = 'Paid';
        $id->paid_date = $request->get('date');
        $id->save();

        alert()->success('Updated', 'Term Fee has been recored')->autoclose(1500);
        return redirect(action('TermFeesController@index'));

    }

    public function getTermFees(Request $request)
    {
        if($request->ajax()) {

           $termid = TermMapping::latest()->value('id');

           $termfees = TermFees::where('term_id', $termid)->get();

           return DataTables::of($termfees)
        //  ->addColumn('first_name', function($termfees) {
        //       return $termfees->Member->first_name;
        //    })
        //   ->addColumn('last_name', function($termfees) {
        //       return $termfees->Member->last_name;
        //    })
        //   ->addColumn('membership', function($termfees) {
        //       return $termfees->Member->membership_number;
        //   })
         //  ->addColumn('overdue', function($termfees) {
         //      return $termfees->Member->overdueFees();
         //  })

          ->addColumn('action', function($row){
                $btn = '<a href="'.action('MembersController@show', $row->Member->id).'" target="_blank" title="View" class="btn btn-round btn-success"><i class="fa fa-info"></i></a>';
                $btn2  = '<a href="'.action('TermFeesController@edit', $row->id).'" title="Payment" class="btn btn-round btn-primary"><i class="fa fa-dollar"></i></a>';

                return $btn." ".$btn2;
            })

            ->editColumn('paid_date', function($termfees){
                return (is_null($termfees->paid_date) ? "-" : date('d/m/Y', strtotime($termfees->paid_date)));
            })

           ->rawColumns(['action'])

           ->make(true);
        }
    }
}
