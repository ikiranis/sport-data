<?php

namespace App;

use App\Traits\Uuids;
use Cviebrock\EloquentSluggable\Sluggable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Team
 *
 * @property int $id
 * @property int|null $logo_id
 * @property string $name
 * @property string $city
 * @property-read \App\Logo $logo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereLogoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereName($value)
 * @mixin \Eloquent
 */
class Team extends Model
{
    use Uuids;
    use Cachable;
    use Sluggable;

    public $incrementing = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'slug',
        'logo_id',
        'name',
        'city'
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
                'source'    => 'name'
            ]
        ];
    }

    // Don't write timestamps at factory
    public $timestamps  = false;

    /**
     * Relation to Logos
     */
    public function logo() {
        return $this->belongsTo('App\Logo');
    }

    /**
     * Relation to posts
     */
    public function posts() {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}
