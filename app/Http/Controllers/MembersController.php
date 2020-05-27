<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Alert;
use DataTables;

use App\Member;
use App\Roll;
use App\Vouchers;
use App\VoucherType;
use Carbon\Carbon;
use App\RollMapping;
use App\RankMapping;
use App\Settings;
use App\Accounts;
use App\Page;
use App\Otheritemmapping;
use App\Flight;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $members = Member::where('active', '!=', 'N')->where('member_type', '=', 'League')->orderby('rank', 'asc')->get();
       $rank = Rankmapping::orderBy('id', 'desc')->paginate(20);
       $flight = Flight::orderBy('id');

       return view('members.index', compact('members', 'rank', 'flight'));
    }

     public function getmembers()
    {
        //

        $members = Member::where('active', '!=', 'N')->where('member_type', '=', 'League')->with('memberrank')->with('vouchers')->get();
        return  $members;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $rank = Rankmapping::orderBy('id', 'desc')->get();

        return view('members.add',compact('rank'));
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
         'rank' => 'required',
         'doj' => 'required',
         'dob' => 'required',
         'type' => 'required',
     ]);

     if ($validateData->fails())
     {
         return Redirect::back()->withErrors($validateData)->withInput();
     }

        //Create Member
       /* if(Carbon::parse(date('Y-m-d',strtotime($request->get('dob'))))->DiffInYears(Carbon::now())<12)  {

            $rank = 20;
        }
        else{

            $rank = 19;
        } */

        $e = new Member();
        $e->membership_number = $request->get('membership');
        $e->first_name = $request->get('firstname');
        $e->last_name = $request->get('lastname');
        $e->rank = $request->get('rank');
        $e->date_joined = Carbon::parse($request->get('doj'));
        $e->date_birth = Carbon::parse($request->get('dob'));
        $e->member_type = $request->get('type');
        $e->active= "Y";
        $e->flight=10;
        $e->save();

        Alert::Success('New Member Added', 'New member has been created')->autoclose(2000);
        return redirect(action('MembersController@index'));
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
       $rank = Rankmapping::orderBy('id','desc')->get();
       $vtype = VoucherType::orderby('id')->get();
       $otheritems = Otheritemmapping::orderby('id')->get();
       $flight = Flight::orderby('id')->get();

      if ($member !=null)
      {

       $count1 = Roll::whereHas('rollmapping', function ($query) {
        $query->whereYear('roll_date', now()->year);
        })
        ->where('status', '!=', 'A')
        ->where ('member_id', '=', $id)
        ->count();

        $count2 = Roll::whereHas('rollmapping', function ($query) {
            $query->whereYear('roll_date', now()->year);
            })
            ->where ('member_id', '=', $id)
            ->count();

        $weeks = Rollmapping::where('roll_year', now()->year)->count();

        if($count1 != 0){

            $attendance = ($count1/$count2)*100;

        }   else    {
            $attendance = 0;
       }

       $attendancesetting = Settings::where('setting', 'Attendance')->value('value');

        return view('members.show', compact('member', 'attendance', 'attendancesetting', 'rank', 'vtype','otheritems', 'flight'));
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

        $member = Member::find($id);
        $rank = Rankmapping::orderBy('id','desc')->get();

        if ($member != null)
        {
            return view('members.edit', compact('member', 'rank'));
        }
        return redirect(action('MembersController@index'));
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
        $validateData = Validator::make($request->all(), [
            'membernumber' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'rank' => 'required',
            'type' => 'required',
        ]);

        if ($validateData->fails())
        {
            return Redirect::back()->withErrors($validateData)->withInput();
        }

        $member = Member::find($id);
        $member->membership_number = $request->get('membernumber');
        $member->first_name = $request->get('firstname');
        $member->last_name = $request->get('lastname');
        $member->Member_type = $request->get('type');
        $member->rank = $request->get('rank');
        $member->flight = $request->get('flight');
        $member->date_joined = Carbon::parse($request->get('doj'));
        $member->date_birth = Carbon::parse($request->get('dob'));
        $member->save();

        Alert::success('Member Updated', 'Members New Details have been recored')->autoclose(1500);
        return redirect(action('MembersController@show', $request->get('member')));
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

    public function inactive($id)
    {
        //
        $member = Member::find($id);

        if ($member != null)
        {
            $member->active = "N";
            $member->save();

            alert()->success('Complete', 'Member has been made inactive')->autoclose(1500);
            return redirect(action('MembersController@index', $member->id));
        }
    }


}
