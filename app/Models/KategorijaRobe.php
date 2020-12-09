<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategorijaRobe extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategorije_roba';

    protected $fillable = ['naziv', 'opis', 'popust_procenti', 'popust_iznos', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function robe()
    {
        return $this->belongsToMany('App\Models\Roba', 'robe_kategorije', 'kategorija_robe_id', 'roba_id');
    }

    public function podkategorije_robe() 
    {
        return $this->hasMany('App\Models\PodKategorijaRobe', 'kategorija_id');
    }
}
