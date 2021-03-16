<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class Modul extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $table = 'moduli';
    protected $fillable = ['naziv'];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'modul_user', 'modul_id', 'user_id');
    }
}
