<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProizvodjacRobe extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'proizvodjaci_roba';

    protected $fillable = ['naziv', 'opis', 'popust_procenti', 'popust_iznos', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function roba()
    {
        return $this->belongsTo('App\Models\Roba', 'proizvodjac_robe_id');
    }
}