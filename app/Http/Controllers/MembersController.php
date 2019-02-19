<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use App\Member;
use App\Roll;
use App\ActiveKids;
use Carbon\Carbon;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $members = DB::table('members')
                ->join('rankmappings', 'members.rank', '=', 'rankmappings.id')
                ->select('members.*', 'rankmappings.rank as memberrank')
                ->get();

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('members.add');
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
         'firstname' => 'required',
         'lastname' => 'required',
         'doj' => 'required|date',
         'dob' => 'required|date',
     ]);

     if ($validateData->fails())
     {
         return Redirect::back()->withErrors($validateData)->withInput();
     }

        //Create Member
        $e = new Member();
        $e->membership_number = $request->get('membership');
        $e->first_name = $request->get('firstname');
        $e->last_name = $request->get('lastname');
        $e->rank = "";
        $e->date_joined = $request->get('doj');
        $e->date_birth = $request->get('dob');
        $e->active= "Y";
        $e->save();

        return redirect(action('MembersController@index'))->with('success', 'Member Added');
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
      $member = Member::find($id);

      if ($member !=null)
      {
       
        return view('members.show', compact('member'));
      }

      return redirect(action('MembersController@index'));
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
