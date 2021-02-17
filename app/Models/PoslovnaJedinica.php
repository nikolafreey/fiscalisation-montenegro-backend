<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoslovnaJedinica extends Model
{
    use HasFactory;

    public function preduzece()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }

    public function racuni()
    {
        return $this->hasMany('App\Models\Racun', 'poslovna_jedinica_id');
    }

    public function depozitWithdraw()
    {
        return $this->hasMany('App\Models\DepozitWithdraw', 'poslovna_jedinica_id');
    }
}
