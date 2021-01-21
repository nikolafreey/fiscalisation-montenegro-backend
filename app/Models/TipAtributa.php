<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipAtributa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tipovi_atributa_roba';

    protected $fillable = ['naziv', 'opis', 'popust_procenti', 'popust_iznos', 'status', 'preduzece_id'];

    // protected static function booted()
    // {
    //     static::addGlobalScope(new UserScope);
    // }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function atributi()
    {
        return $this->hasMany('App\Models\AtributRobe', 'tip_atributa_id');
    }


    public function robe()
    {
        return $this->belongsToMany('App\Models\Roba', 'robe_tipovi_atributa', 'tipovi_atributa_roba_id', 'roba_id');
    }
}
