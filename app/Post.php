<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Traits\Uuids;
use Spatie\Feed\FeedItem;
use Spatie\Feed\Feedable;

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
class Post extends Model implements Feedable
{
    use Sluggable;
    use Uuids;

    public $incrementing = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'slug',
        'photo_id',
        'user_id',
        'athlete_id',
        'match_id',
        'sport_id',
        'title',
        'description',
        'body',
        'reference',
        'approved',
        'author'
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

    // RSS Feed settings and methods
    // @source https://github.com/spatie/laravel-feed

    /**
     * Fields for RSS feed
     *
     * @return $this|array|FeedItem
     */
    public function toFeedItem()
    {
        return FeedItem::create()
            ->id($this->slug)
            ->title($this->title)
            ->summary($this->rssBody())
            ->updated($this->created_at)
            ->link($this->rssLink())
            ->author('WMSports');
    }

    /**
     * Method to return posts for RSS feed
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getFeedItems()
    {
        return self::whereApproved(1)->orderBy('created_at', 'desc')->limit(15)->get();
    }

    /**
     * Get the RSS body text
     *
     * @return string
     */
    public function rssBody()
    {
        return "<p><strong>{$this->description}</strong></p>
            <img src='{$this->photo->full_path_name}' width='350' align='left'>
            <div>{$this->body}</div>";
    }

    /**
     * Get rss post link
     *
     * @return string
     */
    public function rssLink()
    {
        return '/' . $this->slug;
    }

    /**
     * Relation to teams
     */
    public function teams() {
        return $this->belongsToMany('App\Team')->withTimestamps();
    }

    /**
     * Relation to tags
     */
    public function tags() {
        return $this->belongsToMany('App\Tag')->withTimestamps();
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
