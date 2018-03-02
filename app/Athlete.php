<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Athlete
 *
 * @property int $id
 * @property int|null $sport_id
 * @property int|null $photo_id
 * @property string $fname
 * @property string $lname
 * @property int $birthyear
 * @property string $city
 * @property string $country
 * @property int $height
 * @property-read \App\Photo|null $photo
 * @property-read \App\Sport|null $sport
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Athlete whereBirthyear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Athlete whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Athlete whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Athlete whereFname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Athlete whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Athlete whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Athlete whereLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Athlete wherePhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Athlete whereSportId($value)
 * @mixin \Eloquent
 * @property-read string $full_name
 */
class Athlete extends Model
{
    // The attributes that are mass assignable
    protected $fillable = [
        'sport_id',
        'photo_id',
        'fname',
        'lname',
        'birthyear',
        'city',
        'country',
        'height'
    ];

    // Don't write timestamps at factory
    public $timestamps  = false;

    /**
     * Relation to sports
     */
    public function sport() {
        return $this->belongsTo('App\Sport');
    }

    /**
     * Relation to photos
     */
    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    /**
     * Get full name
     * Get it with $athlete->fullName
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->fname . ' ' . $this->lname;
    }


}