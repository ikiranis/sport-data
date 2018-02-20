<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    // The attributes that are mass assignable
    protected $fillable = [
        'slug',
        'team_id',
        'photo_id',
        'user_id',
        'athlete_id',
        'match_id',
        'title',
        'description',
        'body',
        'reference'
    ];

    /**
     * Return the sluggable configuration array for this model.
     * @source https://github.com/cviebrock/eloquent-sluggable
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source'    => 'title'
            ]
        ];
    }

    /**
     * Relation to teams
     */
    public function team() {
        return $this->belongsTo('App\Team');
    }

    /**
     * Relation to photos
     */
    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    /**
     * Relation to photos
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * Relation to athletes
     */
    public function athlete() {
        return $this->belongsTo('App\Athlete');
    }

    /**
     * Relation to matches
     */
    public function match() {
        return $this->belongsTo('App\Match');
    }
}
