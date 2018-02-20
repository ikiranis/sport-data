<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    // The attributes that are mass assignable
    protected $fillable = [
        'sport_id',
        'championship_id',
        'match_date',
        'matchday_id',
        'stadium_id',
        'first_team_id',
        'second_team_id',
        'first_team_score',
        'second_team_score'
    ];

    // Relations with the other models

    /**
     * Relation to sports
     */
    public function sport() {
        return $this->belongsTo('App\Sport');
    }

    /**
     * Relation to championships
     */
    public function championship() {
        return $this->belongsTo('App\Championship');
    }

    /**
     * Relation to match days
     */
    public function matchday() {
        return $this->belongsTo('App\Matchday');
    }

    /**
     * Relation to stadia
     */
    public function stadium() {
        return $this->belongsTo('App\Stadium');
    }

    /**
     * Relation to teams
     */
    public function team() {
        return $this->belongsTo('App\Team');
    }


}
