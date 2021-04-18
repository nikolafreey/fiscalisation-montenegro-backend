<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class Grupa extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }

    protected $naziv = 'naziv';

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
