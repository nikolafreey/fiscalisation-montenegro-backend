<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class Kategorija extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $naziv = 'naziv';

    protected $table = "kategorije";

    protected $fillable = [
        'naziv'
    ];

    public function preduzeca()
    {
        return $this->hasMany('App\Models\Preduzece');
    }

    public function robe_kategorije()
    {
        return $this->belongsToMany('App\Models\Roba', 'robe_kategorije', 'kategorija_id', 'roba_id');
    }

    public function podkategorije()
    {
        return $this->hasMany('App\Models\PodKategorija', 'kategorija_id');
    }
}
