<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podesavanje extends Model
{
    use HasFactory;

    protected $table = "podesavanja";

    protected $guarded = [];

    public function preduzece()
    {
        return $this->belongsTo(Preduzece::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
