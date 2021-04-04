<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class RobaKategorijaPodKategorija extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'roba_id',
        'kategorija_robe_id',
        'podkategorija_robe_id'
    ];

    protected $table = 'robe_kategorije_podkategorije';

    public function robe()
    {
        return $this->belongsTo('App\Models\Roba', 'roba_id');
    }
    public function kategorije_roba()
    {
        return $this->belongsTo('App\Models\KategorijaRobe', 'kategorija_robe_id');
    }
    public function podkategorije_roba()
    {
        return $this->belongsTo('App\Models\PodKategorijaRobe', 'podkategorija_robe_id');
    }
}
