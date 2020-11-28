<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupa extends Model
{
    use HasFactory;

    protected $table = 'grupe';

    protected $fillable = [
        'naziv',
        'opis',
        'popust_procenti',
        'popust_iznos'
    ];

    public function usluge() {
        return $this->hasMany('App\Models\Usluga', 'grupa_id');
    }
}
