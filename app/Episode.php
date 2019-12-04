<?php

namespace App;

use App\Serie;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public $timestamps = false;

    protected $fillable = ['serie_id', 'season', 'number', 'watched'];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function getWatchedAttribute($watched): bool
    {
        return $watched;
    }
}
