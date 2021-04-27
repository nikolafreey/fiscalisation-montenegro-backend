<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveUser extends Model
{
    use HasFactory;

    protected $table = 'personal_access_tokens';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'tokenable_id');
    }

    public function preduzece()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }

    public function poslovna_jedinica()
    {
        return $this->belongsTo('App\Models\PoslovnaJedinica', 'poslovna_jedinica_id');
    }
}
