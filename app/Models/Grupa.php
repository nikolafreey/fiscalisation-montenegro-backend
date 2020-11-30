<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grupa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'grupe';

    protected $fillable = [
        'naziv',
        'opis',
        'popust_procenti',
        'popust_iznos'
    ];

    public function usluge()
    {
        return $this->hasMany('App\Models\Usluga', 'grupa_id');
    }
}
