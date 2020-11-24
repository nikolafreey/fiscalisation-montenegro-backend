<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Djelatnost extends Model
{
    protected $table = "djelatnosti";

    protected $fillable = array('naziv');

    public function preduzeca()
    {
        return $this->belongsToMany('App\Models\Preduzece', 'preduzece_djelatnost', 'djelatnost_id', 'preduzece_id');
    }
}
