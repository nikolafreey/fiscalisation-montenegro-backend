<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JedinicaMjere extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jedinice_mjere';

    protected $fillable = [
        'naziv',
        'kratki_naziv'
    ];

    public function usluge()
    {
        return $this->hasMany('App\Models\Usluga', 'jedinica_mjere_id');
    }
}
