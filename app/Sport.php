<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    // The attributes that are mass assignable
    protected $fillable = [
        'name', 'photo_id'
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
}
