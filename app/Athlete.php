<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    // The attributes that are mass assignable
    protected $fillable = [
        'sport_id',
        'photo_id',
        'fname',
        'lname',
        'birthyear',
        'city',
        'country',
        'height'
    ];

    // Don't write timestamps at factory
    public $timestamps  = false;

    /**
     * Relation to sports
     */
    public function sport() {
        return $this->belongsTo('App\Sport');
    }

    /**
     * Relation to photos
     */
    public function photo() {
        return $this->belongsTo('App\Photo');
    }

}