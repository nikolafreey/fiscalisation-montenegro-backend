<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipAtributa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tipovi_atributa';

    protected $fillable = ['user_id', 'naziv', 'opis'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

   

    public function robe()
    {
        return $this->belongsToMany('App\Models\Roba', 'robe_tipovi_atributa', 'tipovi_atributa_roba_id', 'roba_id');
    }
}
