<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
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
use App\Events;
use App\Eventroll;
use App\Points;
use App\Pointsmaster;


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
       $malemembers =  Member::where('active', '!=', 'N')->where('member_type', '=', 'League')->where('membership_number','LIKE','N%')->get();
       $femalemembers = Member::where('active', '!=', 'N')->where('member_type', '=', 'League')->where('membership_number','LIKE','W%')->get();

       return view('members.index', compact('members', 'rank', 'flight', 'malemembers', 'femalemembers'));
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
        $e->flight=0;
        $e->join_month = Carbon::parse($request->get('doj'))->month;
        $e->join_year = Carbon::parse($request->get('doj'))->year;
        $e->save();

        //Add member to current event rolls
        $memberid = Member::latest()->value('id');
        $events = Events::where('finished', '=', 'N')->get();

        foreach ($events as $r)
        {
            $e = New Eventroll;
            $e->event_id = $r->id;
            $e->member_id = $memberid;
            $e->status = 'N';
            $e->form17 = 'N';
            $e->paid = 'N';
            $e->save();
        }

        Alert()->success('New Member Added', 'New member has been created')->autoclose(2000);
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
       $account = Accounts::where('member_id', $id)->orderBy('id', 'desc')->Paginate(10);
       $pointsreason = Pointsmaster::orderby('id')->get();
       $points = Points::where('year', '=', Carbon::parse(now())->year);

       if ($member !=null)
       {
           if($member->attendance->count() != 0){
               $attendance = ($member->attendance->count()/$member->memberyear->count())*100;
           } else {
               $attendance = 0;
           }


       $attendancesetting = Settings::where('setting', 'Attendance')->value('value');

       if($member->attendancewarning == 3)
       {
           alert()->info('Member has missed the last 3 nights', 'Please contact member to cross off roll')->autoclose(2500);

       }

        return view('members.show', compact('member', 'attendance','attendancesetting', 'rank', 'vtype','otheritems', 'flight', 'account', 'points', 'pointsreason'));
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
        $member->termfees = $request->get('termfees');
        $member->save();

        alert()->success('Member Updated', 'Members New Details have been recored')->autoclose(1500);
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

    public function birthday()
    {
        $birthdays = Member::where('active', 'Y')->get();
        $birthdays = $birthdays->sortby(function($q){
            return $q->birthday;
        });

        return view('members.birthday', compact('birthdays'));
    }


    public function getPayments($id = 0)
    {
        $data = Otheritemmapping::where('id', $id)->first();
        return response()->json($data);
    }

    public function newmembers()
    {
        $month = Rollmapping::latest()->value('roll_month');
        $year = Rollmapping::latest()->value('roll_year');

        $newmembers = Member::where('join_year', $year)->where('join_month', $month)->get();

        return view('members.new', compact('newmembers'));
    }


    public function index_test()
    {
       $members = Member::where('active', '!=', 'N')->where('member_type', '=', 'League')->orderby('rank', 'asc')->get();
       $rank = Rankmapping::orderBy('id', 'desc')->paginate(20);
       $flight = Flight::orderBy('id');
       $malemembers =  Member::where('active', '!=', 'N')->where('member_type', '=', 'League')->where('membership_number','LIKE','N%')->get();
       $femalemembers = Member::where('active', '!=', 'N')->where('member_type', '=', 'League')->where('membership_number','LIKE','W%')->get();
       $followup = $members->with('attendancewarning')->where('warning','!=', 'No');

       return view('members.index_test', compact('members', 'rank', 'flight', 'malemembers', 'femalemembers','followup'));
    }

    public function getMemberlist(Request $request)
    {
       if ($request->ajax()) {

          $members=Member::where('active', '!=', 'N')
                            ->where('member_type', '=', 'League')
                            ->orderby('rank', 'asc')
                            ->with('memberrank', 'flightmap')
                            ->get();

            return DataTables::of($members)
                ->addColumn('account', function($members) {
                    return $members->Accounts->sum('amount');
                })
                ->addColumn('owning', function($members) {
                    return $members->outstanding->count()*10;
                })
                ->addColumn('birthday', function($members) {
                    return $members->birthday;
                })
                ->addColumn('attendance', function($members) {
                    return $members->attendancewarning;
                })
                ->addColumn('action', function($row){

                    $btn = '<a href="'.action('MembersController@show', $row->id).'" target="_blank" title="View" class="btn btn-round btn-success"><i class="fa fa-info"></i></a>';

                    return $btn;
                })



            ->make(true);
        }
    }


    public function memberleave()
    {
        $roll = Rollmapping::latest()->take(0)->value('roll_date');
        $leave = StaffAttendance::where('date', '=', Carbon::parse($roll))->where('member_id', $this->id)->get();

        if ($leave->count() > 0)
        {
            return 'Yes';
        }
        else
        {
            return 'No';
        }
    }



}
