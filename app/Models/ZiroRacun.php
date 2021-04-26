<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class ZiroRacun extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $naziv = 'broj_racuna';

    protected $table = 'ziro_racuni';

    protected $fillable = [
        'broj_racuna',
        'fizicko_lice_id'
    ];

    public function scopeFilterByPermissions($query)
    {
        if (auth()->user()->hasRole('SuperAdmin')) {
            return $query;
        }

        $query= $query->where('preduzece_id', getAuthPreduzeceId(request()));

        return $query;
    }

    public function preduzece()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }

    public function fizickoLice()
    {
        return $this->belongsTo('App\Models\FizickoLice', 'fizicko_lice_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
