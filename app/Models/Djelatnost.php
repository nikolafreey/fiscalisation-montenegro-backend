<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Djelatnost extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "djelatnosti";

    protected $fillable = array('naziv');

    public function preduzeca()
    {
        return $this->belongsToMany('App\Models\Preduzece', 'preduzece_djelatnost', 'djelatnost_id', 'preduzece_id');
    }
}
