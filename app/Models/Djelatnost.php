<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class Djelatnost extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $naziv = 'naziv';

    protected $table = "djelatnosti";

    protected $fillable = [
        'naziv'
    ];

    public function preduzeca()
    {
        return $this->belongsToMany('App\Models\Preduzece', 'preduzece_djelatnost', 'djelatnost_id');
    }
}
