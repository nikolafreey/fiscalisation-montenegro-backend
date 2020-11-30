<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FizickoLice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fizicka_lica';

    protected $fillable = [
        'ime',
        'prezime',
        'jmbg',
        'ib',
        'adresa',
        'telefon',
        'email',
        'zanimanje',
        'radno_mjesto',
        'drzavljanstvo',
        'nacionalnost',
        'cv_link',
        'avatar',
        'preduzece_id'
    ];

    public function ziroRacuni()
    {
        return $this->hasMany('App\Models\ZiroRacun', 'fizicko_lice_id');
    }

    public function preduzeca()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }
}
