<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Traits\ImaAktivnost;
use App\Traits\GenerateUuid;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, GenerateUuid, HasApiTokens, HasRoles, ImaAktivnost; //LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $naziv = 'email';

    protected $fillable = [
        'email',
        'password',
        'ime',
        'prezime',
        'jezik',
        'avatar',
        'paket',
        'tip_id',
        'kod_operatera'
    ];

    public function preduzeca()
    {
        return $this->belongsToMany('App\Models\Preduzece', 'user_tip_korisnika', 'user_id', 'preduzece_id');
    }

    public function poslovne_jedinice()
    {
        return $this->hasMany('App\Models\PoslovnaJedinica');
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

    public function racuni()
    {
        return $this->hasMany('App\Models\Racun', 'user_id');
    }

    public function guestRacuni()
    {
        return $this->belongsToMany('App\Models\Racun', 'users_racuni',  'user_id', 'racun_id');
    }

    public function dokumenti()
    {
        return $this->hasMany(Dokument::class);
    }

    public function podesavanje()
    {
        return $this->hasOne(Podesavanje::class);
    }

    public function activeUsers()
    {
        return $this->hasMany('App\Models\ActiveUser', 'tokenable_id');
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

    public function setAvatarAttribute($value)
    {
        return $this->attributes['avatar'] = Storage::disk('public')->putFile('avatars', $value);
    }

    public function getPunoImeAttribute()
    {
        return "{$this->ime} {$this->prezime}";
    }
}
