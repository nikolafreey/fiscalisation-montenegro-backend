<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Dokument extends Model
{
    use HasFactory;

    protected $table = 'dokumenti';

    protected $naziv = 'naziv';

    protected $fillable = [
        'naziv',
        'opis',
        'file',
        'user_id',
        'preduzece_id',
        'kategorija_dokumenta_id'
    ];

    public function scopeFilterByPermissions($query)
    {
        $query= $query->where('preduzece_id', getAuthPreduzeceId(request()));

        if (auth()->user()->can('view all Dokument')) {
            return $query;
        }

        if (auth()->user()->can('view owned Dokument')) {
            return $query->where('user_id', auth()->id());
        }
    }

    public function kategorije()
    {
        return $this->belongsTo(KategorijaDokumenta::class);
    }

    public function preduzece()
    {
        return $this->belongsTo(Preduzece::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setFileAttribute($value)
    {
        $this->attributes['file'] = Storage::disk('public')->putFile('dokumenti', $value);
    }
}
