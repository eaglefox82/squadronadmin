<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Member;
use App\ActiveKids;
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
        $members=Member::all();
        $active=Activekids::all();
        return view('home', compact ('members', 'active'));
    }
}
