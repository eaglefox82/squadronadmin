<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Member;
use App\Roll;
use App\Rollmapping;
use App\RollStatus;
use App\ActiveKids;

class RollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    $rollid = Rollmapping::latest()->value('id');

    $currentroll = DB::table('roll')
                    ->join('members', 'members.id', '=', 'roll.member_id')
                    ->join('rankmappings', 'members.rank', '=', 'rankmappings.id' )
                    ->join('rollstatus', 'roll.status', '=', 'status_id')
                    ->Select('members.*', 'roll.roll_id', 'rankmappings.*', 'rollstatus.status', 'roll.id')
                    ->where('roll.roll_id', '=', $rollid)
                    ->orderby ('rankmappings.id')
                    ->get();

        return view('roll.index', compact('currentroll'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('roll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $validateData = Validator::make($request->all(),[
            'rolldate' => 'required|date'
        ]);

        if ($validateData ->fails())
        {
            return Redirect::back()->withErrors($validateData)->withInput();
        }

        //Create Rollmapping
        $e = new Rollmapping();
        $e->roll_date = $request->get('rolldate');
        $e->save();

        //create Roll
        $rollid = Rollmapping::latest()->value('id');

        $members = Member::all();
       
            foreach ($members as $m)
            {
                $r=new Roll;
                $r->member_id = $m->id;
                $r->roll_id = $rollid;
                $r->Status = 'A';
                $r->save();
            }
            
        return redirect(action('RollController@index'))->with('success', 'Roll Added');
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

    public function paid($id)
    {
    
        $r = Roll::find($id);

        if ($r != null)
     {
        $r->status = "C";
        $r->save();

         return redirect(action('RollController@index'))->with ('success', 'Member Paid');
     }

     return redirect(action('RollController@index'));
    
    }

    public function voucher($id)
    {    
               $r = Roll::find($id);

        if ($r != null)
     {
      
        // Update Roll Status
        $r->status = "V";
        $r->save();

        // Insert Record into ActiveKids Voucher
       $voucher = new ActiveKids();
        $voucher->member_id = $r->member_id;
        $voucher->voucher_number = 'Weekly Subs';
        $voucher->balance = -10;
     //   $voucher->date = Carbon\Carbon::now()->toDateString();
        $voucher->save();


         return redirect(action('RollController@index'))->with ('success', 'Member Paid with Vocuher');
     }
     return redirect(action('RollController@index'));    
    }

    public function notpaid($id)
    {    
        $r = Roll::find($id);

        if ($r != null)
     {
        $r->status = "P";
        $r->save();

         return redirect(action('RollController@index'))->with ('success', 'Member Present');
     }
     return redirect(action('RollController@index'));    
    }

    public function updateRoll($id)
    {
        $o = Roll::find($id);

        if ($o != null)
     {
        $o->status = "C";
        $o->save();

         return redirect(action('MembersController@show', $o->member_id))->with ('success', 'Member Present');
     }
     return redirect(action('MembersController@index'));    
    }

}
