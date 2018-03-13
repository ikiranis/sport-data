<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Match
 *
 * @property int $id
 * @property int|null $sport_id
 * @property int|null $championship_id
 * @property string $match_date
 * @property int|null $matchday_id
 * @property int|null $stadium_id
 * @property int|null $first_team_id
 * @property int|null $second_team_id
 * @property int|null $first_team_score
 * @property int|null $second_team_score
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Championship|null $championship
 * @property-read \App\Matchday|null $matchday
 * @property-read \App\Sport|null $sport
 * @property-read \App\Stadium|null $stadium
 * @property-read \App\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereChampionshipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereFirstTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereFirstTeamScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereMatchDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereMatchdayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereSecondTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereSecondTeamScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereSportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereStadiumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $season_id
 * @property-read \App\Season|null $season
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereSeasonId($value)
 * @property-read \App\Team|null $first_team
 * @property-read string $teams
 * @property-read \App\Team|null $second_team
 */
class Match extends Model
{
    // The attributes that are mass assignable
    protected $fillable = [
        'sport_id',
        'championship_id',
        'season_id',
        'match_date',
        'matchday_id',
        'stadium_id',
        'first_team_id',
        'second_team_id',
        'first_team_score',
        'second_team_score'
    ];

    protected $dates = ['match_date'];

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
     * Relation to seasons
     */
    public function season() {
        return $this->belongsTo('App\Season');
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
     * Relation to first team
     */
    public function first_team() {
        return $this->belongsTo('App\Team', 'first_team_id');
    }

    /**
     * Relation to second team
     */
    public function second_team() {
        return $this->belongsTo('App\Team', 'second_team_id');
    }

    /**
     * Get two teams string
     *
     * Get it with $match->teams
     *
     * @return string
     */
    public function getTeamsAttribute() {
        return $this->first_team->name . ' VS ' . $this->second_team->name;
    }


}
