<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtributRobe extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'atributi_roba';

    protected $fillable = ['user_id', 'tip_atributa_id', 'naziv', 'opis', 'popust_procenti', 'popust_iznos'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function tip_atributa_id()
    {
        return $this->belongsTo('App\Models\TipAtributa', 'id');
    }

    public function cijena()
    {
        return $this->hasMany('App\Models\CijenaRobe', 'atribut_robe_id');
    }

    public function porez()
    {
        return $this->belongsTo('App\Models\Porez', 'id');
    }
}
