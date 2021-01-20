<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZiroRacun extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ziro_racuni';

    protected $fillable = [
        'broj_racuna',
        'fizicko_lice_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
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
