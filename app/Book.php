<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function course()
    {
        return $this->hasOne('App\Course', 'id', 'courseID');
    }

    public function history()
    {
        return $this->hasMany('App\MemberBook', 'bookID', 'id')->orderBy('returned', 'desc');
    }

    public function current()
    {
        return $this->hasMany('App\MemberBook', 'bookID', 'id')->where('returned', null)->first();
    }
}
