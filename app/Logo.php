<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Logo
 *
 * @property int $id
 * @property string $path
 * @property string $filename
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logo whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logo wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Logo whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $full_path_name
 */
class Logo extends Model
{
    use Uuids;

    public $incrementing = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'path',
        'filename'
    ];

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
