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
        'naziv'
    ];

    public function dokumenti()
    {
        return $this->hasMany(Dokument::class);
    }
}
