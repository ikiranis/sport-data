<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matchday extends Model
{
    // The attributes that are mass assignable
    protected $fillable = [
        'season_id',
        'matchday'
    ];

    // Don't write timestamps at factory
    public $timestamps  = false;

    /**
     * Relation to seasons
     */
    public function season() {
        return $this->belongsTo('App\Season');
    }
}
