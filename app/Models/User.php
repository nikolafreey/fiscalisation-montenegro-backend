<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'ime',
        'prezime',
        'jezik',
        'avatar',
        'paket',
        'preuzece_id',
        'tip_id'

    ];

    public function preduzece()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }
    public function tip_korisnika()
    {
        return $this->belongsTo('App\Models\TipKorisnika', 'tip_id');
    }

    public function moduli()
    {
        return $this->belongsToMany('App\Models\Modul', 'modul_user', 'user_id', 'modul_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
