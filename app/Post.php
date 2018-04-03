<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Traits\Uuids;

/**
 * App\Post
 *
 * @property int $id
 * @property string $slug
 * @property int|null $team_id
 * @property int|null $photo_id
 * @property int|null $user_id
 * @property int|null $athlete_id
 * @property int|null $match_id
 * @property string $title
 * @property string $description
 * @property string $body
 * @property string $reference
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Athlete|null $athlete
 * @property-read \App\Match|null $match
 * @property-read \App\Photo|null $photo
 * @property-read \App\Team|null $team
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereAthleteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post wherePhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUserId($value)
 * @mixin \Eloquent
 * @property int|null $sport_id
 * @property-read \App\Sport|null $sport
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereSportId($value)
 * @property int $approved
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereApproved($value)
 */
class Post extends Model
{
    use Sluggable;
    use Uuids;

    public $incrementing = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'slug',
        'team_id',
        'photo_id',
        'user_id',
        'athlete_id',
        'match_id',
        'sport_id',
        'title',
        'description',
        'body',
        'reference',
        'approved'
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
    public function teams() {
        return $this->belongsToMany('App\Team');
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

    /**
     * Relation to sports
     */
    public function sport() {
        return $this->belongsTo('App\Sport');
    }

    /**
     * Relation to comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments() {
        return $this->hasMany('App\Comment');
    }

}
