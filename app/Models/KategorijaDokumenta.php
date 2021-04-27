<?php

namespace App\Models;

use App\Traits\ImaAktivnost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategorijaDokumenta extends Model
{
    use HasFactory, ImaAktivnost;

    protected $naziv = 'naziv';

    protected $table = 'kategorije_dokumenata';

    protected $fillable = [
        'naziv',
        'preduzece_id',
    ];

    public function scopeFilterByPermissions($query)
    {
        if (auth()->user()->hasRole('SuperAdmin')) {
            return $query;
        }

        $query = $query->where('preduzece_id', getAuthPreduzeceId(request()));

        return $query;
    }

    public function preduzece()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }

    public function dokumenti()
    {
        return $this->hasMany(Dokument::class);
    }
}
