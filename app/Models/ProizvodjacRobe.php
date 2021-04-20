<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class ProizvodjacRobe extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $naziv = 'naziv';

    protected $table = 'proizvodjaci_roba';

    protected $fillable = [
        'naziv',
        'opis',
        'popust_procenti',
        'popust_iznos',
        'status'
    ];

    public function scopeFilterByPermissions($query)
    {
        $query= $query->where('preduzece_id', getAuthPreduzeceId(request()));

        if (auth()->user()->can('view all ProizvodjacRobe')) {
            return $query;
        }

        if (auth()->user()->can('view owned ProizvodjacRobe')) {
            return $query->where('user_id', auth()->id());
        }
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function roba()
    {
        return $this->belongsTo('App\Models\Roba', 'roba_id');
    }
}
