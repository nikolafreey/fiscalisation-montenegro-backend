<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Porez extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'porezi';

    protected $fillable = [
        'naziv',
        'stopa'
    ];

    public function usluge()
    {
        return $this->hasMany('App\Models\Usluga', 'porez_id');
    }

    public function cijena_robe()
    {
        return $this->hasMany('App\Models\CijenaRobe', 'porez_id');
    }
}
