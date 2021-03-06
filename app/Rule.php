<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Rule
 *
 * @property int $id
 * @property int|null $championship_id
 * @property mixed $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rule whereChampionshipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rule whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rule whereId($value)
 * @mixin \Eloquent
 */
class Rule extends Model
{
    use Uuids;

    // The attributes that are mass assignable
    protected $fillable = [
        'name', 'description'
    ];

    // Don't write timestamps at factory
    public $timestamps  = false;

    public $incrementing = false;

}
