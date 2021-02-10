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

    public function attendanceReport()
    {
        $memberlist = Member::where('member_type', '=', 'League')->get();
        $totalweeks = Rollmapping::where('roll_year', '=', Carbon::now()->year)->get();
        $totalevents = Event::Where('year', '=', Carbon::now()->year)->get();

        return view('report.attendance', compact('memberlist', 'totalweeks', 'totalevents'));
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

    
}
