<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class Grupa extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $naziv = 'naziv';

    protected $table = 'grupe';

    protected $fillable = [
        'naziv',
        'opis',
        'popust_procenti',
        'popust_iznos'
    ];

    public function scopeFilterByPermissions($query)
    {
        if (auth()->user()->hasRole('SuperAdmin')) {
            return $query;
        }

        $query = $query->where('preduzece_id', getAuthPreduzeceId(request()));

        return $query;

        // if (auth()->user()->can('view all Grupa')) {
        //     return $query;
        // }

        // if (auth()->user()->can('view owned Grupa')) {
        //     return $query->where('user_id', auth()->id());
        // }
    }

    public function usluge()
    {
        return $this->hasMany('App\Models\Usluga', 'grupa_id');
    }
}
