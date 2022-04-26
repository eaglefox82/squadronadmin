<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;


use App\Events;
use App\Member;
use App\Eventroll;
use App\Eventlevels;
use App\Points;
use App\Otheritemmapping;
use App\Other_attendance;


use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $date = Carbon::now();
        $eventsthisyear = Events::where('year','=', Carbon::now()->year)->count();
        $events=Events::where('finished', '!=', 'Y')->orderby('event_date')->get();
        $yearremain=Events::where('finished', '!=', 'Y')->where('year','=', Carbon::now()->year)->count();
        $levels = Eventlevels::get();

        $memberevents = EventRoll::with(array('Events' => function($q) {
            return $q->where('year', '=', Carbon::now()->year);
        }))
        ->count();

        $membereventattendance = EventRoll::with(array('Events' => function($q) {
            return $q->where('year', '=', Carbon::now()->year);
        }))
        ->where('status', '=', 'A')->count();

        if($memberevents != null)
            {
             $percentage =  ($membereventattendance / $memberevents)*100;
            } else {
              $percentage =  '0';
            }


        return view('events.index', compact('events', 'date', 'eventsthisyear', 'yearremain', 'levels', 'percentage'));
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
            'eventname' => 'required',
            'eventlevel' => 'required',
            'eventdate' => 'required',
            'eventcost' => 'required',
        ]);

        if ($validateData->fails())
        {
            return Redirect::back()->withErrors($validateData)->withInput();
        }

        // Add Event Master Record
        $e = New Events();
        $e->event = $request->get('eventname');
        $e->event_level = $request->get('eventlevel');
        $e->event_date = Carbon::parse($request->get('eventdate'));
        $e->year = Carbon::parse($request->get('eventdate'))->year;
        $e->amount = $request->get('eventcost');
        $e->finished = "N";
        $e->save();

        //Create Event Roll
        $eventid = Events::latest()->value('id');

        $members = Member::where('active', '=', 'Y')->Where('member_type', '=', 'League')->orderBy('rank','asc')->get();

        foreach ($members as $m)
        {
            $r=New EventRoll;
            $r->event_id = $eventid;
            $r->member_id = $m->id;
            $r->status = "N";
            $r->form17 = "N";
            $r->paid = "N";
            $r->save();

        }

        if($request->get('eventcost') != 0)
        {
            $e=New Otheritemmapping;
            $e->item = $request->get('eventname')." - ".Carbon::parse($request->get('eventdate'))->year;
            $e->active = "Y";
            $e->amount = $request->get('eventcost');
            $e->type = "F";
            $e->save();

        }

        alert()->success('New Event Added', 'New Event has been created')->autoclose(2000);
        return redirect(action('EventController@index'));

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
        $event = Events::find($id);
        $roll = EventRoll::where('event_id','=', $id)->get();
        $attendance = EventRoll::where('event_id','=', $id)->where('status', '=', 'Y')->count();
        $form17 = EventRoll::where('event_id','=', $id)->where('form17', '=', 'Y')->count();
        $paid = EventRoll::where('event_id','=', $id)->where('paid', '=', 'Y')->count();
        $cost = Events::where('id', $id)->value('amount');
        $attended = EventRoll::where('event_id', '=', $id)->where('status', '=', 'A')->count();
        $others = Other_attendance::where('event_id', $id)->where('status', '!=', 'N')->get();
        $member = Member::where('active', 'Y')->where('member_type', 'League')->get();

        if($attended != 0){
         $percentage =  ($attended / EventRoll::where('event_id','=', $id)->count()) * 100;
        } else {
           $percentage =  0;
        };

        return view('events.roll', compact('event', 'roll', 'attendance', 'form17', 'paid', 'percentage', 'cost', 'attended', 'others', 'member', 'id'));
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
        $event = events::find($id);

        if($event->id != null) {

            return view('event.edit', compact('event'));

        }

        return redirect(action('EventController@index'));
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

        $r = Events::find($id);
        $r->finished = 'Y';
        $r->save();


        if($r->amount != 0)
        {
            $item = $r->event." - ".$r->year;
            $e=Otheritemmapping::find($item);
            $e->active = "N";
            $e->save();

        }

        alert()->error("Event Removed", "Event has been removed");

        return redirect(action('EventController@index'));



    }

    public function eventattending($id)
    {
        $r = Eventroll::find($id);
        $event = EventRoll::where('id','=', $id)->value('event_id');
        $level = Events::where('id', '=', $event)->value('event_level');
        $event_level = Eventlevels::where('id', '=', $level)->value('level');
        $points = Eventlevels::where('id', '=', $level)->value('points_rank');
        $currentstatus = Eventroll::where('id', '=', $id)->value('status');

        if($currentstatus == "Y")
        {
            alert()->error('Member already attending', "Nothing has been updated");
            return redirect(action('EventController@show', $r->event_id));
        }

        if ($r != null)
        {
                $r->status = "Y";
                $r->save();


            Alert::success('Member Attending Function', 'Member has been marked as Attending')->autoclose(1500);
            return redirect(action('EventController@show', $r->event_id));



        }

        Alert::warning('Record not found', "Please check and try again")->autoclose(2000);
        return redirect(action('EventController@show', $r->event_id));
    }

    public function eventattended($id, $other)
    {
        if($other != "Y")
        {
            $r = Eventroll::find($id);
            $event = EventRoll::where('id','=', $id)->value('event_id');
            $level = Events::where('id', '=', $event)->value('event_level');

            $points = Eventlevels::where('id', '=', $level)->value('points_rank');
            $currentstatus = Eventroll::where('id', '=', $id)->value('status');
            $eventname = Events::where('id', '=', $event)->value('event');
        } else {
            $r = Other_attendance::find($id);
            $event = Other_attendance::where('id','=', $id)->value('event_id');
            $level = Events::where('id', '=', $event)->value('event_level');
            $eventname = Events::where('id', '=', $event)->value('event');
            $points = Eventlevels::where('id', '=', $level)->value('points_rank');
            $currentstatus = Other_attendance::where('id', '=', $id)->value('status');
        }

        if($currentstatus == "A")
            {
                alert()->error('Member already marked in attendance', "Nothing has been updated");
                return redirect(action('EventController@show', $r->event_id));
            }

        if ($r != null)
            {
                $r->status = "A";
                $r->save();

                if($other != "Y")
                    if (config('global.Squadron_Points') != 'N')
                    {
                        {
                            $e=new Points;
                            $e->member_id = $r->member_id;
                            $e->value = $points;
                            $e->Reason ="Attendance - ".$eventname;
                            $e->year = Carbon::now()->year;
                            $e->save();
                        }
                    }

                Alert::success('Member marked as attended', 'Member has been marked as in attendance')->autoclose(1500);
                return redirect(action('EventController@show', $r->event_id));

            }

        Alert::warning('Record not found', "Please check and try again")->autoclose(2000);
        return redirect(action('EventController@show', $r->event_id));

    }

    public function eventform17($id, $others)
    {
        if($others != 'Y')
        {
            $r = Eventroll::find($id);
            $currentstatus = Eventroll::where('id', '=', $id)->value('form17');
        } else {
            $r = Other_attendance::find($id);
            $currentstatus = Other_attendance::where('id', '=', $id)->value('form17');
        }
        if($currentstatus == "Y")
        {
            alert()->error('Form 17 already provided', "Nothing has been updated");
            return redirect(action('EventController@show', $r->event_id));
        }

        if ($r != null)
        {
            $r->form17 = "Y";
            $r->save();

            Alert::success('Member Form 17', 'Member has Prodvided their Form 17')->autoclose(1500);
            return redirect(action('EventController@show', $r->event_id));
        }

    }

    public function eventpaid($id, $others)
    {
        if($others != 'Y')
        {
            $r = Eventroll::find($id);
            $currentstatus = Eventroll::where('id', '=', $id)->value('paid');
        } else {
            $r = Other_attendance::find($id);
            $currentstatus = Other_attendance::where('id', '=', $id)->value('paid');
        }

        if($currentstatus == "Y")
        {
            alert()->error('Member has paid', "Nothing has been updated");
            return redirect(action('EventController@show', $r->event_id));
        }

        if ($r != null)
        {
            $r->paid = "Y";
            $r->save();

            Alert::success('Member Paid', 'Member has been marked as Paid')->autoclose(1500);
            return redirect(action('EventController@show', $r->event_id));
        }

    }

    public function inactive($id)
    {
        //

        $r = Events::find($id);
        $r->finished = 'Y';
        $r->save();


        if($r->amount != 0)
        {
            $item = $r->event." - ".$r->year;
            $e=Otheritemmapping::where('item', $item)->first();
            $e->active = "N";
            $e->save();

        }

        alert()->error("Event Removed", "Event has been removed")->autoclose(1500);

        return redirect(action('EventController@index'));



    }

    public function addNonMember(Request $request)
    {

        // Add Event Master Record
        $e = New Other_attendance();
        $e->member_id = $request->get('member');
        $e->event_id = $request->get('event');
        $e->first_name = $request->get('firstname');
        $e->last_name = $request->get('lastname');
        $e->relationship = $request->get('relationship');
        $e->status = "Y";
        $e->form17 = "N";
        $e->paid = "N";
        $e->save();

        alert()->success("Person Added", "Person has been added to the event")->autoclose(1500);
        return redirect(action('EventController@show', $request->get('event')));

    }

    public function listPastEvents()
    {
        $event = Events::where('finished', '=', 'Y')->orderby('event_date', 'desc')->get();
        return view('events.pastlist', compact('event'));
    }
}
