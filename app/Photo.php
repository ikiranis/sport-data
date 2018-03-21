<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Photo
 *
 * @property int $id
 * @property string $path
 * @property string $filename
 * @property string|null $reference
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string $full_path_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Photo extends Model
{
    use Uuids;

    public $incrementing = false;

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
     * Get it with $photo->fullPathName
     *
     * @return string
     */
    public function getFullPathNameAttribute()
    {
        return '/images/' . $this->path . '/' . $this->filename;
    }

}
