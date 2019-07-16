<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Request;

class Requestitems extends Model
{
    //
    protected $fillable = [
        'id','request_id', 'item'
    ];


    public function request()
    {
        return $this->hasMany('App\Requests');
    }

}