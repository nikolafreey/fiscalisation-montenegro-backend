<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CijenaRobe extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cijene_roba';

    protected $fillable = ['user_id', 'nabavna_cijena_bez_pdv', 'nabavna_cijena_sa_pdv', 'cijena_bez_pdv', 'porezi_id','roba_id','atribut_id', 'pdv_iznos', 'ukupna_cijena'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function atribut_robe()
    {
        return $this->belongsTo('App\Models\AtributRobe', 'id');
    }

    public function roba()
    {
        return $this->belongsTo('App\Models\Roba', 'id');
    }

    public function porez()
    {
        return $this->belongsTo('App\Models\Porez', 'id');
    }
}
