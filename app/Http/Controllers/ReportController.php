<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Alert;
use Mail;

use App\Member;
use App\Roll;
use App\RollMapping;
use App\RollStatus;
use App\Accounts;
use PDF;
use App\Users;
use App\Event;
use App\Eventroll;
use App\Completedform;
use App\Points;
Use DataTables;

class ReportController extends Controller
{
    //

    public function printRoll($id)
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
        $reportdate = Carbon::now();

        $pdf = PDF::loadView('report.roll',  compact('members', 'rolldate', 'rollid', 'strength', 'present', 'id', 'rolls', 'reportdate'));



        return $pdf->download(date("jS F Y",strtotime($rolldate)). ' roll.pdf');
        return view('report.roll',  compact('members', 'rolldate', 'rollid', 'strength', 'present', 'id', 'rolls', 'reportdate'));

    }

    public function attendance()
    {
        $memberlist = Member::where('member_type', '=', 'League')->get();
        $totalrolls = Rollmapping::where('roll_year', '=', Carbon::now()->year)->get();
        $totalevents = Event::Where('year', '=', Carbon::now()->year)->get();

        return view('report.attendance', compact('memberlist', 'totalrolls', 'totalevents'));
    }

    public function welcome()
    {
        return view('report.welcome');
    }

    public function past()
    {
        $form19 = Completedform::orderby('id','DESC')->get();
        return view('report.past',compact('form19'));
    }

    public function downloadpast($id)
    {

        $data = Completedform::find($id)->value('form_name');

        if($data != null)
        {
            return Storage::disk('completedforms')->download($data);
        }
        alert()->error('No Report Found');


    }

    public function email()
    {
        $to_name = 'Brendan Fox';
        $to_email = 'fox82b@gmail.com';
        $data = array('name'=>'AAL Edmondson Park', 'body' => 'A Test Email');

        Mail::send('emails.test', $data, function($message) use ($to_name, $to_email){
            $message->to($to_email, $to_name)->subject('Welcome to the Australian Air League');

            $message->from('oc.edmondsonpark@airleague.com.au', 'Australian Air League - Edmondson Park');

        });

    }

    public function getAttendance (Request $request)
    {
        $memberlist = Member::where('member_type', '=', 'League')->get();
        $totalrolls = Rollmapping::where('roll_year', '=', Carbon::now()->year)->count();
        $totalevents = Event::Where('year', '=', Carbon::now()->year)->count();
        $totalattendance = $totalrolls + $totalevents;

        if ($request->ajax){

        $points = Member::query()
        ->join('Rollmappings', 'Rollmappings.member_id', '=', 'Members.id')
        ->join('eventrolls', 'eventrolls.member_id', '=', 'Members.id')
        ->join('Rolls', 'Rolls.member_id', '=', 'Members.id')
        ->select('members.first_name', 'members.last_name', 'members.id')
        ->selectRaw("Count(rolls.status) 'rollcount'")
        ->selectRaw("Count(eventrolls.status) 'eventcount'")
        ->selectRaw("Count(rolls.status) + Count(eventrolls.status) 'totalcount'")
        ->selectRaw("totalcount / '.$totalattendance.' * 100 'percentage'")
        ->selectRaw("RANK() OVER (ORDER BY percentage DESC) 'rank'")
        ->where('rollmappings.roll_year', '=', Carbon::now()->year)
        ->where('members.member_type', '=', 'League')
        ->where('rollmapping.id', '=', 'rolls.roll_id')
        ->where('rolls.status', '!=', 'A')
        ->where('eventrolls.status', '=', 'A')
        ->groupBy('members.id')
        ->groupBy('members.first_name')
        ->groupBy('members.last_name')
        ->orderByDesc('percentage')
        ->get();

        return DataTables::of($points)->make(true);
        }


    }

    public function attendance_test()
    {
        $totalrolls = Rollmapping::where('roll_year', '=', Carbon::now()->year)->get();
        $totalevents = Event::Where('year', '=', Carbon::now()->year)->get();

        return view('report.points_test', compact('totalrolls', 'totalevents'));
    }

    public function print_points()
    {
        $date = Carbon::today()->toDateString();
        $year =  Carbon::parse(Carbon::now())->year;
        $points = Points::query()
            ->join('members', 'members.id', '=', 'points.member_id')
            ->select('points.member_id', 'members.first_name', 'members.last_name')->selectRaw('SUM(points.value) as TotalPoints')
            ->selectRaw("RANK() OVER (ORDER BY SUM(points.value) DESC) 'rank'")
            ->where('Year','=', $year)
            ->groupBy('member_id')
            ->groupBy('first_name')
            ->groupBy('last_name')
            ->orderByDesc('Totalpoints')
            ->get();

          $pdf = PDF::loadView('report.points_report', compact('points', 'date'));

            return $pdf->download('.Points Report - '.date("jS F Y",strtotime($date)).'.pdf');

            return view('report.points_report', compact('points', 'date'));

    }


}
