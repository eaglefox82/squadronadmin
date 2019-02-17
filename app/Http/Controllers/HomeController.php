<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Member;
use App\ActiveKids;
use App\Roll;
use App\Rollmapping;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       $activeroll = Rollmapping::latest()->value('id');

       $currentroll = DB::table('roll')
       ->join('rollmapping', 'roll.roll_id' , '=', 'rollmapping.id' )
       ->join('members', 'members.id', '=', 'roll.member_id')
       ->join('rankmappings', 'members.rank', '=', 'rankmappings.id' )
       ->join('rollstatus', 'roll.status', '=', 'status_id')
       ->Select('members.*', 'roll.roll_id', 'rankmappings.*', 'rollstatus.status')
       ->where('roll.roll_id', '=', $activeroll)
       ->where('roll.status', '!=', 'A')
       ->orderby ('rankmappings.id')
       ->get();
       
        $members=Member::all();
        $active=Activekids::all();
        $Roll=Roll::all();
        return view('home', compact ('members', 'active', 'currentroll'));
    }
}
