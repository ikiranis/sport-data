<?php

namespace App;

use App\Traits\Uuids;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use Cachable;

    // The attributes that are mass assignable
    protected $fillable = ['name'];
}
