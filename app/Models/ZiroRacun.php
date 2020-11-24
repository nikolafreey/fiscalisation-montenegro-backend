<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZiroRacun extends Model
{
    use HasFactory;

    protected $table = 'ziro_racuni';

    protected $fillable = [
        'broj_racuna',
        'preduzece_id',
        'fizicko_lice_id'
    ];

    public function preduzece() {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }

    public function fizickoLice() {
        return $this->belongsTo('App\Models\FizickoLice', 'fizicko_lice_id');
    }
    
}
