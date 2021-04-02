<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImaAktivnost;

class DepozitWithdraw extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function poslovnaJedinica()
    {
        return $this->belongsTo('App\Models\PoslovnaJedinica', 'poslovna_jedinica_id');
    }

    public function preduzece()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }

    // protected static function booted()
    // {
    //     static::addGlobalScope(new UserScope);
    // }
}
