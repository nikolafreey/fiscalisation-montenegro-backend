<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;
    protected $table = 'moduli';
    protected $fillable = ['naziv'];


    public function users(){
        return $this->belongsToMany('App\Models\User','modul_user','modul_id','user_id');
    }
}
