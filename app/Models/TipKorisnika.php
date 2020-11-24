<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipKorisnika extends Model
{
    use HasFactory;
    protected $table = 'tipovi_korisnika';
    protected $fillable = ['naziv'];

    public function users(){
        return $this->hasMany('App\Models\User','tip_id');
    }
}
