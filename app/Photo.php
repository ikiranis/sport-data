<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    // The attributes that are mass assignable
    protected $fillable = [
        'path',
        'filename',
        'reference'
    ];

    /**
     * Get the path with images folder
     *
     * @param $value
     * @return string
     */
//    public function getPathAttribute($value)
//    {
//        return '/images/' . $value;
//    }

    /**
     * Get full path/filename with images folder
     *
     * @return string
     */
    public function getFullPathNameAttribute()
    {
        return '/images/' . $this->path . '/' . $this->filename;
    }

}
