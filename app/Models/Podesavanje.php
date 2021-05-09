<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podesavanje extends Model
{
    use HasFactory;

    protected $table = "podesavanja";

    protected $guarded = [];

    public function scopeFilterByPermissions($query)
    {
        if (auth()->user()->hasRole('SuperAdmin')) {
            return $query;
        }

        $query = $query->where('preduzece_id', getAuthPreduzeceId(request()));

        return $query;
        // if (auth()->user()->can('view all AtributRobe')) {
        //     return $query;
        // }

        // if (auth()->user()->can('view owned AtributRobe')) {
        //     return $query->where('user_id', auth()->id());
        // }
    }

    public function preduzece()
    {
        return $this->belongsTo(Preduzece::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
