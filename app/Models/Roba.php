<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roba extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'robe';

    protected $fillable = ['naziv', 'opis', 'detaljni_opis', 'ean', 'status', 'proizvodjac_robe_id', 'jedinica_mjere_id', 'preduzece_id'];

    public function proizvodjac_robe()
    {
        return $this->hasOne('App\Models\Proizvodjac', 'id');
    }

    public function jedinica_mjere()
    {
        return $this->hasOne('App\Models\JedinicaMjere', 'id');
    }

    public function preduzece()
    {
        return $this->hasMany('App\Models\Preduzece', 'id');
    }

    public function robe_kategorije()
    {
        return $this->belongsToMany('App\Models\Kategorija', 'robe_kategorije', 'roba_id', 'kategorija_id');
    }

    public function robe_tipovi()
    {
        return $this->belongsToMany('App\Models\CijenaRobe', 'robe_cijene_roba', 'cijena_robe_id', 'roba_id');
    }
}
