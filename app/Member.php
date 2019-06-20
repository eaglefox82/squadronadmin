<?php

namespace App;
use Carbon\Carbon;
use App\Activekids;
use App\Roll;
use App\Srequest;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $fillable = [
        'id', 'membership_number', 'first_name', 'last_name', 'rank', 'date_joined', 'date_birth', 'active'
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['date_birth'])->age;
    }

    public function getServiceAttribute()
    {
      $now = Carbon::now();

      $service = Carbon::parse(date('Y-m-d',strtotime($this->date_joined)))->DiffInYears($now);
      return $service;  
    }

    public function ActiveKids()
    {
        return $this->hasMany('App\ActiveKids', 'member_id', 'id') ->where('active', '=', 'Y');
    }
    
    public function MemberRank()
    {
        return $this->hasOne('App\Rankmapping', 'id', 'rank');
    }

    public function vouchers()
    {
        return $this->hasMany('App\ActiveKids');
    }

    public function roll()
    {
        return $this->hasMany('App\Roll');
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
}
