<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    //Venue Type
    // public function venue_type()
    // {
    //     return $this->hasOne('App\VenueType');
    // }
    protected $guarded = [];

    //Venue Services
    public function venue_service()
    {
        return $this->hasOne('App\VenueService',);
    }

    //Venue Photos
    public function photos()
    {
        return $this->hasMany('App\VenuePhoto');
    }

    //Contact Info
    public function contact()
    {
        return $this->hasOne('App\ContactInfo');
    }

    //Location
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

}
