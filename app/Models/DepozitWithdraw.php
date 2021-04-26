<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImaAktivnost;

class DepozitWithdraw extends Model
{
    use HasFactory;

    protected $fillable = ['iznos_depozit', 'iznos_withdraw', 'poslovna_jedinica_id'];

    public function scopeFilterByPermissions($query)
    {
        if (auth()->user()->hasRole('SuperAdmin')) {
            return $query;
        }

        $query= $query->where('preduzece_id', getAuthPreduzeceId(request()));

        return $query;

        // if (auth()->user()->can('view all DepozitWithdraw')) {
        //     return $query;
        // }

        // if (auth()->user()->can('view owned DepozitWithdraw')) {
        //     return $query->where('user_id', auth()->id());
        // }
    }

    public function poslovnaJedinica()
    {
        return $this->belongsTo('App\Models\PoslovnaJedinica', 'poslovna_jedinica_id');
    }

    public function preduzece()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }
}
