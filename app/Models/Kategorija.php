<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\FuncCall;
use App\Traits\ImaAktivnost;

class Kategorija extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $table = "kategorije";

    protected $fillable = array('naziv');

    public function preduzeca()
    {
        return $this->hasMany('App\Models\Preduzece');
    }

    public function robe_kategorije()
    {
        return $this->belongsToMany('App\Models\Roba', 'robe_kategorije', 'kategorija_id', 'roba_id');
    }

    public function podkategorije()
    {
        return $this->hasMany('App\Models\PodKategorija', 'kategorija_id');
    }
}
