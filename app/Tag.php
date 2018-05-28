<?php

namespace App;

use App\Traits\Uuids;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Uuids;
    use Sluggable;

    public $incrementing = false;

    // Don't write timestamps at factory
    public $timestamps  = false;

    // The attributes that are mass assignable
    protected $fillable = ['id', 'slug', 'name'];

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

    /**
     * Relation to posts
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}
