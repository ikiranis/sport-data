<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    // The attributes that are mass assignable
    protected $fillable = [
        'path',
        'filename'
    ];

}
