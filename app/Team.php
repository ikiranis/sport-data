<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    // The attributes that are mass assignable
    protected $fillable = [
        'logo_id',
        'name',
        'city'
    ];

    // Don't write timestamps at factory
    public $timestamps  = false;

    /**
     * Relation to Logos
     */
    public function logo() {
        return $this->hasOne('App\Logo');
    }
}
