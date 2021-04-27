<?php

namespace App\Models;

use App\Traits\ImaAktivnost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ugovor extends Model
{
    use HasFactory, ImaAktivnost;

    protected $naziv = 'naziv';

    protected $table = 'ugovori';

    protected $fillable = [
        'naziv',
        'file',
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

    public function setFileAttribute($value)
    {
        return $this->attributes['file'] = Storage::disk('public')->putFile('ugovori', $value);
    }
}
