<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Season
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Season whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Season whereName($value)
 * @mixin \Eloquent
 */
class Season extends Model
{
    // The attributes that are mass assignable
    protected $fillable = [
        'name'
    ];

    // Don't write timestamps at factory
    public $timestamps  = false;
}
