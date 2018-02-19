<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

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


}
