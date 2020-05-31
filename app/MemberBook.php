<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;

class MemberBook extends Model
{
    //
    public function book()
    {
        return $this->hasOne('App\Book', 'id', 'bookID' );
    }

    public function member()
    {
        return $this->hasOne('App\Member', 'id', 'memberID');
    }
}
