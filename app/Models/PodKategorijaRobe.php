<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class PodKategorijaRobe extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }

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

    // protected static function booted()
    // {
    //     static::addGlobalScope(new UserScope);
    // }

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
