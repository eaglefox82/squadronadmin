<?php

namespace App;
use Carbon\Carbon;

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
        return $this->hasMany('App\ActiveKids', 'member_id', 'id');
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

}
