<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use App\ActiveKids;
use App\Member;

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
        $vouchers = DB::table('activekids')
                        ->join ('members', 'activekids.member_id',  '=', 'members.id')
                        ->select('activekids.*', 'members.first_name', 'members.last_name')
                        ->where('activekids.active', '=', 'y')
                        ->orderBy('id', 'desc')
                        ->get();

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
            'date' => 'required',
            'voucher'=> 'required',
        ]);
        if ($validateData->fails() )
            {
            return Redirect::back()->WithErrors($validateData) ->withInput();
            }

            $e = new ActiveKids();
            $e->member_id = $request->get('member');
            $e->voucher_number = $request->get('voucher');
            $e->date_received = $request->get('date');
            $e->balance = 100;
            $e->active = "Y";
            $e->save();

            return redirect(action('MembersController@show', $request->get('member')))->with ('success', 'Voucher Recored');
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

    public function complete($id)
    {
        $v = ActiveKids::find($id);

        if ($v != null)
            {
                $v->Active = 'N';
                $v->save();
                return redirect(action('ActiveKidsController@index'));
            }
            return redirect(action('ActiveKidsControler@index'));

    }
}
