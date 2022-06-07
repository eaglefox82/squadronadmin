<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Alert;

use App\Member;
use App\Roll;
use App\RollMapping;
use App\RollStatus;
use App\Accounts;
use Illuminate\Support\Facades\Auth;
use App\Pointsmaster;
use App\Points;
use App\Settings;
use App\StaffAttendance;
use DataTables;

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
        $rollid = RollMapping::latest()->value('id');
        $rolldate = RollMapping::latest()->value('roll_date');

        $members = Roll::with(array('member' => function($q) {
            return $q->orderby('rank');
        }))
        ->where('roll_id', '=', $rollid)->orderby('status')->get();

        $online = Settings::where('setting', 'Online Meetings')->value('value');

        return view('roll.index', compact('members', 'rolldate', 'rollid', 'online'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function parade()
    {
        $rollid = RollMapping::latest()->value('id');
        $rolldate = RollMapping::latest()->value('roll_date');

        $fparade = Roll::with(['Member' => function ($q) {
            $q->orderby('rank');
        }])
        ->where('status', '!=', 'A')->where('roll_id', '=', $rollid)->get();

        return view('roll.first', compact('rolldate', 'fparade'));
    }



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


        //Create Rollmapping
        $date = Carbon::parse($request->get('date'))->format('Y-m-d');
        $e = new RollMapping();
        $e->roll_date = Carbon::parse($request->get('date'));
        $e->roll_year = Carbon::parse($date)->year;
        $e->roll_month = Carbon::parse($date)->month;
        $e->roll_week = Carbon::parse($date)->weekOfMonth;
        $e->roll_strength = Member::Where('active', '=', 'y')->where('member_type', '=', 'League')->count();
        $e->save();

        //create Roll
        $rollid = RollMapping::latest()->value('id');

        $members = Member::where('active', '=', 'Y')->Where('member_type', '=', 'League')->orderBy('rank','asc')->get();

        foreach ($members as $m)
        {
            $r=new Roll;
            $r->member_id = $m->id;
            $r->roll_id = $rollid;
            $r->Status = 'A';
            $r->save();
        }

        alert()->success('New Roll Created')->autoclose(1500);
        return redirect(action('RollController@index'));
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
        if ($id==0){
            $rollid = RollMapping::latest()->value('id');
        } else {
            $rollid = $id;
        }
        $rolldate = RollMapping::Where('id', '=', $rollid)->value('roll_date');

        $members = Roll::with(array('member' => function($q) {
            return $q->orderby('rank');
        }))
        ->where('roll_id', '=', $rollid)->get();

        $strength = RollMapping::Where('id', '=', $rollid)->value('roll_strength');
        $present = Roll::Where('roll_id', '=', $rollid)->where('status', '!=', 'A')->count();

        $rolls = RollMapping::orderby('id','desc')->get();

        return view('roll.past', compact('members', 'rolldate', 'rollid', 'strength', 'present', 'id', 'rolls'));
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

    public function updateRollAccount($id)
    {
        $o = Roll::find($id);
        $rollid = RollMapping::latest()->value('id');

        if ($o != null)
              {
            // Check if ActiveKids Balance is not less than 0
            if ($o->member->Accounts->sum('amount') >= 10)
                {
                // Update Roll Status
                    $o->status = "V";
                    $o->paidrollid = $rollid;
                    $o->save();

                // Insert Record into ActiveKids Voucher
                $voucher = new Accounts();
                $voucher->member_id = $o->member_id;
                $voucher->Reason = 'Weekly Subs';
                $voucher->amount = -10;
                $voucher->user = Auth::user()->username;
                $voucher->save();

                Alert()->Success("Member Paid", "Past Subs have been paid from Account Balance")->autoclose(1500);
                return redirect(action('MembersController@show', $o->member_id));
            }
            else
            {
                //Not Enough money in the account
                Alert()->error("Error", "Insufficient Account Balance")->autoclose(1500);
                return redirect(action('MembersController@show', $o->member_id));
            }
        }

        return redirect(action('MemberController@index'));
    }

    public function notPresent($id)
    {
        $r = Roll::find($id);

        if ($r != null)
        {
            $r->status = "A";
            $r->save();

            Alert()->success('Member not Present', 'Member has been marked as not present')->autoclose(1500);
            return redirect(action('RollController@index'));
        }

        return redirect(action('RollController@index'));
    }

    public function online($id)
    {
        $r = Roll::find($id);

        if ($r != null)
        {
            $r->status = "O";
            $r->save();

            Alert()->success('Member mark present', 'Member is present online')->autoclose(1500);
            return redirect(action('RollController@index'));
        }

        return redirect(action('RollController@index'));
    }

    public function rollstatus($id, $status, $rolltype)
    {
        $r = Roll::find($id);
        $points = Pointsmaster::where('Reason', '=', 'Attendance')->value('Value');
        $member = Roll::where('id', '=', $id)->value('member_id');
        $year = Carbon::parse(now())->year;
        $rollid = RollMapping::latest()->value('id');
        $pastrollid = Roll::where('id', '=', $id)->value('roll_id');

        switch ($status) {
            // Define variables for member paying using account and check balance
            case 'V':

                // Check Account Balance and back out if account balance is too low
                if($r->member->Accounts->sum('amount') < 10)
                {
                    Alert()->error("Error", "Insufficient Account Balance")->autoclose(1500);
                    return redirect(action('RollController@index'));
                }

                $paid = 'Y';
                $title = 'Member Present';
                $message = 'Member paid using account balance';

                // Add Voucher use record
                $voucher = new Accounts();
                $voucher->member_id = $r->member_id;
                $voucher->Reason = 'Weekly Subs';
                $voucher->amount = -10;
                $voucher->user = Auth::user()->username;
                $voucher->save();

                break;

            // Define variables for member who didn't pay
            case 'P':
                $paid = 'N';
                $title = "Member Present";
                $message = "Member has not paid";
                break;

            // Define variables for member who is online
            case 'O':
                $paid = 'N';
                $title = "Member Online";
                $message = "Member marked as present online";
                break;

            // Define variables for member who paid cash
            case 'C':
                $paid = "Y";
                $title = "Member Present";
                $message = "Member paid by Cash";
                break;

            // Define variables for member who is not present
            case 'A':
                $paid = "N";
                $title = "Member Absent";
                $message = "Member marked as absent";
                break;

            default:
                Alert()->error("Error", "System Error has occured")->autoclose(1500);

                return redirect(action('RollController@index'));
        }
        // Update Roll Status
        $r->status = $status;
        if($paid != 'N')
            {
                $r->paidrollid = $rollid;
            }
        $r->save();

        // Add Points to Member if function is turned on
        if (config('global.Squadron_Points') != 'N')
        {
            $p=new Points();
            $p->member_id = $member;
            $p->value = $points;
            $p->year = $year;
            $p->reason = "Squadron Night Attendance";
            $p->save();
        }

        alert()->success($title, $message)->autoclose(1500);

        // Redirect to Current Roll or Past Roll ('P' is for past roll)
        if ($rolltype == "P")
        {
            return redirect(action('RollController@show', $pastrollid));
        }
        else
        {
            return redirect(action('RollController@index'));
        }
    }



    public function getCurrentRoll(Request $request)
    {
        $rollid = RollMapping::latest()->value('id');


        $roll = Roll::with(array('member' => function($q) {
            return $q->orderby('rank');
        }))
        ->where('roll_id', '=', $rollid)->orderby('status')
        ->with ('rollstatus')
        ->get();

        return DataTables::of($roll)

                ->addColumn('account', function($roll) {
                    return $roll->member->Accounts->sum('amount');
                })

                ->addColumn('action', function($row){
                    $btn = '<a href="'.action('MembersController@show', $row->member_id).'" target="_blank" title="View" class="btn btn-round btn-info"><i class="fa fa-info"></i></a>';

                    if ($row->status == 'A')
                    {
                        $btn .= '<a href="'.action('RollController@rollstatus', [$row->id, 'C']).'" class="btn btn-round btn-success" title="Paid Cash""><i class="fa fa-check"></i></a>';
                        $btn .= '<a href="'.action('RollController@rollstatus', [$row->id, 'P']).'" class="btn btn-round btn-danger" title="Not Paid"><i class="fa fa-times"></i></a>';
                        $btn .= '<a href="'.action('RollController@rollstatus', [$row->id, 'P']).'" class="btn btn-round btn-warning" title="Account Payment"><i class="fa fa-money"></i></a>';
                    }

                    return $btn;
                })

            ->make(true);


    }

     public function index_test()
    {
        //
        $rollid = RollMapping::latest()->value('id');
        $rolldate = RollMapping::latest()->value('roll_date');

        $members = Roll::with(array('member' => function($q) {
            return $q->orderby('rank');
        }))
        ->where('roll_id', '=', $rollid)->orderby('status')->get();

        $online = Settings::where('setting', 'Online Meetings')->value('value');

        return view('roll.index_test', compact('members', 'rolldate', 'rollid', 'online'));
    }

    public function staffleave()
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
