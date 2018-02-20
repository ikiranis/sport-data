<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'city'
    ];

    // Don't write timestamps at factory
    public $timestamps  = false;
}
