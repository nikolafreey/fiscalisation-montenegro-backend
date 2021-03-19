<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class TipKorisnika extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $table = 'tipovi_korisnika';
    protected $fillable = ['naziv'];
    /*
    public function users()
    {
        return $this->hasMany('App\Models\User', 'tip_id');
    }*/

    // protected static function booted()
    // {
    //     static::addGlobalScope(new UserScope);
    // }

    public function dozvole()
    {
        return $this->hasMany('App\Models\DozvolaTipKorisnika', 'tip_korisnika_id');
    }
}
