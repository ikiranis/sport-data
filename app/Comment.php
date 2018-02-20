<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // The attributes that are mass assignable
    protected $fillable = [
        'post_id',
        'body',
        'author',
        'email'
    ];

}
