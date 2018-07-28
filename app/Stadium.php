<?php

namespace App;

use App\Traits\Uuids;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Stadium
 *
 * @property int $id
 * @property string $name
 * @property string $city
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stadium whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stadium whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stadium whereName($value)
 * @mixin \Eloquent
 */
class Stadium extends Model
{
    use Uuids;
    use Cachable;

    public $incrementing = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'city'
    ];

    // Don't write timestamps at factory
    public $timestamps  = false;
}
