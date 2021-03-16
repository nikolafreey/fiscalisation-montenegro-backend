<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class ProizvodjacRobe extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $table = 'proizvodjaci_roba';

    protected $fillable = ['naziv', 'opis', 'popust_procenti', 'popust_iznos', 'status'];

    // protected static function booted()
    // {
    //     static::addGlobalScope(new UserScope);
    // }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function roba()
    {
        return $this->belongsTo('App\Models\Roba', 'roba_id');
    }
}
