<?php

namespace App;

use App\Traits\Uuids;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * App\Sport
 *
 * @property int $id
 * @property int|null $photo_id
 * @property string $slug
 * @property string $name
 * @property-read \App\Photo|null $photo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sport findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sport whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sport wherePhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Sport whereSlug($value)
 * @mixin \Eloquent
 */
class Sport extends Model
{
    use Sluggable;
    use Uuids;
    use Cachable;

    public $incrementing = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'name', 'slug', 'photo_id', 'mainpage'
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
     * Relation to photos
     */
    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    public function championship()
    {
        return $this->hasMany('App\Championship');
    }
}
