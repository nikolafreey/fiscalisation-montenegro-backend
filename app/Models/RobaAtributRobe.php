<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RobaAtributRobe extends Model
{
    use HasFactory;

    protected $fillable = ['roba_id', 'atribut_id'];

    protected $table = 'robe_atributi_roba';

    public function roba()
    {
        return $this->belongsTo('App\Models\Roba', 'roba_id');
    }
    public function atribut_robe()
    {
        return $this->belongsTo('App\Models\AtributRobe', 'atribut_id');
    }
}
