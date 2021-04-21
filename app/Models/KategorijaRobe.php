<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class KategorijaRobe extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $naziv = 'naziv';

    protected $table = 'kategorije_roba';

    protected $fillable = [
        'naziv',
        'opis',
        'popust_procenti',
        'popust_iznos',
        'status'
    ];

    public function scopeFilterByPermissions($query)
    {
        if (auth()->user()->hasRole('SuperAdmin')) {
            return $query;
        }

        $query= $query->where('preduzece_id', getAuthPreduzeceId(request()));

        if (auth()->user()->can('view all KategorijaRobe')) {
            return $query;
        }

        if (auth()->user()->can('view owned KategorijaRobe')) {
            return $query->where('user_id', auth()->id());
        }
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function robe_kateogorije_podkategorije()
    {
        return $this->hasMany('App\Models\RobaKategorijaPodKategorija', 'kategorija_robe_id');
    }

    public function podkategorije_robe()
    {
        return $this->hasMany('App\Models\PodKategorijaRobe', 'kategorija_id');
    }
}
