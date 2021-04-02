<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImaAktivnost;

class DepozitWithdraw extends Model
{
    use HasFactory, ImaAktivnost;

    protected $fillable = array('iznos_depozit', 'iznos_withdraw', 'poslovna_jedinica_id');

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }
}
