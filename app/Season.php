<?php

namespace App;

use App\Traits\Uuids;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Season
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Season whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Season whereName($value)
 * @mixin \Eloquent
 * @property int|null $championship_id
 * @property-read \App\Championship|null $championship
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Season whereChampionshipId($value)
 */
class Season extends Model
{
    use Uuids;
    use Cachable;

    public $incrementing = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'championship_id',
        'rule_id'
    ];

    // Don't write timestamps at factory
    public $timestamps  = false;

    /**
     * Relation with championships
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function championship()
    {
        return $this->belongsTo('App\Championship');
    }

    /**
     * Relation with rules
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rule()
    {
        return $this->belongsTo('App\Rule');
    }
}
