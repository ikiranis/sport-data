<?php

namespace App;

use App\Traits\Uuids;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Matchday
 *
 * @property int $id
 * @property int|null $season_id
 * @property int $matchday
 * @property-read \App\Season|null $season
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Matchday whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Matchday whereMatchday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Matchday whereSeasonId($value)
 * @mixin \Eloquent
 */
class Matchday extends Model
{
    use Uuids;
    use Cachable;

    public $incrementing = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'season_id',
        'matchday'
    ];

    // Don't write timestamps at factory
    public $timestamps  = false;

    /**
     * Relation to seasons
     */
    public function season() {
        return $this->belongsTo('App\Season');
    }
}
