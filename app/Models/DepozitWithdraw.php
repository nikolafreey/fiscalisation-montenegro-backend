<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepozitWithdraw extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }
}
