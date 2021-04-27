<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class PodKategorijaRobe extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $naziv = 'naziv';

    protected $table = 'podkategorije_roba';

    protected $fillable = [
        'naziv',
        'opis',
        'popust_procenti',
        'popust_iznos',
        'status',
        'kategorija_id'
    ];

    public function scopeFilterByPermissions($query)
    {
        if (auth()->user()->hasRole('SuperAdmin')) {
            return $query;
        }

        $query = $query->where('preduzece_id', getAuthPreduzeceId(request()));

        return $query;

        // if (auth()->user()->can('view all PodKategorijaRobe')) {
        //     return $query;
        // }

        // if (auth()->user()->can('view owned PodKategorijaRobe')) {
        //     return $query->where('user_id', auth()->id());
        // }
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function kategorija()
    {
        return $this->belongsTo('App\Models\Kategorija', 'id');
    }

    public function robe_kateogorije_podkategorije()
    {
        return $this->hasMany('App\Models\RobaKategorijaPodKategorija', 'podkategorija_robe_id');
    }
}
