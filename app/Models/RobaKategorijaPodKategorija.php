<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RobaKategorijaPodKategorija extends Model
{
    use HasFactory;

    protected $fillable = ['roba_id', 'kategorija_robe_id', 'podkategorija_robe_id'];

    protected $table = 'robe_kategorije_podkategorije';

    public function robe()
    {
        return $this->belongsTo('App\Models\Roba', 'id');
    }
    public function kategorije_roba()
    {
        return $this->belongsTo('App\Models\KategorijaRobe', 'id');
    }
    public function podkategorije_roba()
    {
        return $this->belongsTo('App\Models\PodKategorijaRobe', 'id');
    }
}
