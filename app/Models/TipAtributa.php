<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class TipAtributa extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $naziv = 'naziv';

    protected $table = 'tipovi_atributa_roba';

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

        if (auth()->user()->can('view all TipAtributa')) {
            return $query;
        }

        if (auth()->user()->can('view owned TipAtributa')) {
            return $query->where('user_id', auth()->id());
        }
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function atributi()
    {
        return $this->hasMany('App\Models\AtributRobe', 'tip_atributa_id');
    }


    public function robe()
    {
        return $this->belongsToMany('App\Models\Roba', 'robe_tipovi_atributa', 'tipovi_atributa_roba_id', 'roba_id');
    }
}
