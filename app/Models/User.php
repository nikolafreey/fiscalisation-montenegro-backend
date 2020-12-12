<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\GenerateUuid;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, GenerateUuid; //LogsActivity;

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

    public function preduzeca()
    {
        return $this->belongsToMany('App\Models\Preduzece', 'user_tip_korisnika', 'user_id', 'preduzece_id');
    }
    public function tip_korisnika()
    {
        return $this->belongsToMany('App\Models\TipKorisnika', 'user_tip_korisnika', 'user_id', 'tip_korisnika_id');
    }

    public function moduli()
    {
        return $this->belongsToMany('App\Models\Modul', 'modul_user', 'user_id', 'modul_id');
    }

    public function tip_atributa()
    {
        return $this->hasMany('App\Models\TipAtributa', 'user_id');
    }

    public function atribut_robe()
    {
        return $this->hasMany('App\Models\AtributRobe', 'user_id');
    }

    public function cijena_robe()
    {
        return $this->hasMany('App\Models\CijenaRobe', 'user_id');
    }

    public function kategorija_robe()
    {
        return $this->hasMany('App\Models\KategorijaRobe', 'user_id');
    }

    public function podkategorija_robe()
    {
        return $this->hasMany('App\Models\PodKategorijaRobe', 'user_id');
    }

    public function proizvodjac_robe()
    {
        return $this->hasMany('App\Models\ProizvodjacRobe', 'user_id');
    }

    public function dozvole($preduzece_id)
    {
        return DB::table('users')
            ->join('user_tip_korisnika', 'users.id', '==', 'user_tip_korisnika.user_id')
            ->join('dozvole_tip_korisnika', 'user_tip_korisnika.tip_korisnika_id', '==', 'dozvole_tip_korisnika.tip_korisnika_id')
            ->where('user_tip_korisnika.preduzece_id', '==', $preduzece_id)
            ->select('dozvole_tip_korisnika.*')
            ->get();
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
