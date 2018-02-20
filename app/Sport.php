<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    // The attributes that are mass assignable
    protected $fillable = [
        'name'
    ];

    // Don't write timestamps at factory
    public $timestamps  = false;
}
