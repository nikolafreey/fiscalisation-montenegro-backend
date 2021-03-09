<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImaAktivnost;

class PoslovnaJedinica extends Model
{
    use HasFactory, ImaAktivnost;

    protected $table = 'poslovne_jedinice';

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

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }
}
