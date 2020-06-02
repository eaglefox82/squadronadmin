<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    public function books()
    {
        return $this->hasMany('App\Book', 'courseID', 'id');
    }
}
