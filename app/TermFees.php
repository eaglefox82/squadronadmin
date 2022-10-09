<?php

namespace App;

use App\Member;

use Illuminate\Database\Eloquent\Model;

class TermFees extends Model
{
    //

     protected $table = 'termfees';

     public function member()
    {
        return $this->hasOne('App\Member', 'id', 'member_id')->orderBy('rank');
    }

    public function termmapping()
    {
        return $this->hasOne('App\TermMapping', 'id', 'term_id');
    }

}
