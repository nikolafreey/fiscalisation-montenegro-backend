<?php

namespace App\Models;

use App\Traits\ImaAktivnost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtributRobe extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $table = 'atributi_roba';

    protected $fillable = ['tip_atributa_id', 'naziv', 'opis', 'popust_procenti', 'popust_iznos'];

    // protected static function booted()
    // {
    //     static::addGlobalScope(new UserScope);
    // }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function tip_atributa()
    {
        return $this->belongsTo('App\Models\TipAtributa', 'tip_atributa_id');
    }

    public function cijena()
    {
        return $this->hasMany('App\Models\CijenaRobe', 'atribut_robe_id');
    }

    public function porez()
    {
        return $this->belongsTo('App\Models\Porez', 'id');
    }

    public function robe()
    {
        return $this->belongsToMany('App\Models\Roba', 'robe_atributi_roba', 'atributi_roba_id', 'roba_id');
    }
}
