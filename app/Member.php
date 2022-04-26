<?php

namespace App;
use Carbon\Carbon;
use App\Vouchers;
use App\Roll;
use App\Rollmapping;
use App\Srequest;
use App\Flight;
use App\Points;
use App\Eventroll;
use App\Events;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $fillable = [
        'id', 'membership_number', 'first_name', 'last_name', 'rank', 'date_joined', 'date_birth', 'active'
    ];

    public function getAgeAttribute()
    {
        $now = Carbon::now();
        $age = (Carbon::parse(date('Y-m-d',strtotime($this->date_birth)))->DiffinMonths($now))/12;
        return $age;
    }

    public function getServiceAttribute()
    {
      $now = Carbon::now();

      $service = (Carbon::parse(date('Y-m-d',strtotime($this->date_joined)))->DiffInMonths($now))/12;

      return $service;
    }

    public function Vouchers()
    {
        return $this->hasMany('App\Vouchers', 'member_id', 'id');
    }

    public function MemberRank()
    {
        return $this->hasOne('App\Rankmapping', 'id', 'rank');
    }

    public function roll()
    {
        return $this->hasMany('App\Roll');
    }

    public function eventroll()
    {
        return $this->hasMany('App\Eventroll');
    }

    public function outstanding()
    {
        return $this->roll()->where('status', '=', 'P');
    }

    public function rollstatus()
    {
        $rollid = Rollmapping::latest()->value('id');
        return $this->hasOne('App\Roll')
                ->where('roll_id', '=', $rollid)
                ->join('rollstatus', 'rollstatus.status_id', '=', 'roll.status')
                ->select('rollstatus.status as rstatus', 'roll.id as rollid');
    }

    public function requests()
    {
        return $this->hasMany('App\Srequest');
    }

    public function currentrequests()
    {
        return $this->requests()->where('complete', '=', 'N');
    }

    public function accounts()
    {
        return $this->hasmany('App\accounts', 'member_id', 'id')
                 ->orderby('id', 'DESC');
    }

    public function accountbalance()
    {
        return $this->hasmany('App\accounts', 'member_id', 'id')
                    ->sum('amount');
    }

    public function flightmap()
    {
        return $this->hasOne('App\Flight','id', 'flight' );
    }

    public function books()
    {
        return $this->hasMany('App\MemberBook', 'memberID', 'id');
    }

    protected $with = array('accounts');


    public function getBirthdayAttribute()
    {
        $birthday = Carbon::parse($this->date_birth);

        $birthday->year(date('Y'));

        $birthday = Carbon::now()->diffInDays($birthday, false) +1;

            if ($birthday < 0) {
                $birthday = Carbon::parse($this->date_birth);

                $birthday->year(date('Y'))->addyear();

                $birthday = Carbon::now()->diffInDays($birthday, false) +1;
            }

        return $birthday;
    }

    public function getAnnualsubsAttribute()
    {
        $subs =Carbon::parse($this->date_joined);
        $date = Carbon::now();
        $yearstart = $date->copy()->startOfYear();

        $due = 'N';

        if($subs < $yearstart ) {
            $due = 'Y';
        }

        return $due;

    }

    public function pointslink()
    {
        return $this->hasMany('App\Points', 'member_id', 'id');
    }

    public function points()
    {
        $year = Carbon::now()->year;
        return $this->pointslink()->where('year', $year);
    }

    public function rolllink()
    {
        return $this->hasMany('App\Roll', 'member_id', 'id');
    }

    public function eventrolls()
    {
        return $this->hasMany('App\Eventroll', 'member_id', 'id');
    }

    public function attendance()
    {
        $year = Carbon::now()->year;
        return $this->rolllink()->wherehas('rollmapping', function ($query){
            $query->whereYear('roll_date', now()->year);
        })
        ->where('status','!=', 'A');
    }

    public function event()
    {
        return $this->eventrolls()->wherehas('event', function ($query){
            $query->where('year', Carbon::now()->year);
        })
        ->where('status', '!=', 'Y')
        ->where('status', '!=', 'N');
    }

    public function memberyear()
    {
        $year = Carbon::now()->year;
        return $this->rolllink()->wherehas('rollmapping', function ($query){
            $query->whereYear('roll_date', now()->year);
        });
    }

    public function eventyear()
    {
        return $this->eventrolls()->wherehas('event', function ($query){
            $query->where('year', Carbon::now()->year);
        });
    }

    public function getPointrankAttribute(){
        $year = Carbon::parse(Carbon::now())->year;

        $pointrank = Points::query()
            ->select('member_id')->selectRaw('SUM(value) as TotalPoints')
            ->where('Year','=', $year)
            ->groupBy('member_id')
            ->orderbyDesc('TotalPoints')
            ->get();

        return $pointrank->search(function($points){
            return $points->member_id == $this->id;
        }) + 1;

        return $pointrank;

    }

    public function getattendancewarningAttribute()
    {
       $week1 = Rollmapping::latest()->take(0)->value('id');
       $week2 = Rollmapping::latest()->skip(1)->take(1)->value('id');
       $week3 = Rollmapping::latest()->skip(2)->take(1)->value('id');



        $week1a = Roll::where('Roll_id',$week1)->where('member_id', $this->id)->value('status');
        $week2a = Roll::where('Roll_id',$week2)->where('member_id', $this->id)->value('status');
        $week3a = Roll::where('Roll_id',$week3)->where('member_id', $this->id)->value('status');

        $count = 0;

       if ($week1a == 'A')
       {
           $count = $count + 1;
       }

       $week2a = Roll::where('Roll_id',$week2)->where('member_id', $this->id)->value('status');

       if ($week2a == 'A')
       {
          $count = $count + 1;
       }

       $week3a = Roll::where('Roll_id',$week3)->where('member_id', $this->id)->value('status');

       if ($week3a == 'A')
       {
           $count = $count + 1;
       }

         if ($count == 3)
         {
              $warning = 'Yes';
         }
            else
            {
                $warning = 'No';
            }

       return $warning;

    }


}
