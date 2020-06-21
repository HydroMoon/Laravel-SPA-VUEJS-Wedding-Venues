<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = [];

    //Venues
    public function venue()
    {
        return $this->hasMany('App\Venue');
    }
}
