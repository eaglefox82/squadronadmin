<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Request;

class RequestItem extends Model
{
    //
    protected $table = "requestitems";

    protected $fillable = [
        'id','request_id', 'item'
    ];


    public function request()
    {
        return $this->hasMany('App\Requests');
    }

}
