<?php

namespace App\Models;

use App\PreduzecaIndexConfigurator;
use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use ScoutElastic\Searchable;
use App\Traits\ImaAktivnost;

class Preduzece extends Model
{
    use HasFactory, SoftDeletes, GenerateUuid, ImaAktivnost;

    protected $naziv = 'kratki_naziv';

    protected $table = 'preduzeca';

    protected $fillable = [
        'kratki_naziv',
        'puni_naziv',
        'oblik_preduzeca',
        'adresa',
        'grad',
        'drzava',
        'telefon',
        'telefon_viber',
        'telefon_whatsapp',
        'telefon_facetime',
        'fax',
        'email',
        'website',
        'pib',
        'pdv',
        'djelatnost_id',
        'iban',
        'bic_swift',
        'kontakt_ime',
        'kontakt_prezime',
        'kontakt_telefon',
        'kontakt_viber',
        'kontakt_whatsapp',
        'kontakt_facetime',
        'kontakt_email',
        'twitter_username',
        'instagram_username',
        'facebook_username',
        'skype_username',
        'logotip',
        'thumbnail',
        'opis',
        'lokacija_lat',
        'lokacija_long',
        'status',
        'privatnost',
        'verifikovan',
        'pdv_obveznik',
        'kategorija_id',
        'preduzece_id',
        'pecat',
        'sertifikat',
        'pecatSifra',
        'sertifikatSifra',
        'enu_kod',
        'software_kod',
        'kod_operatera',
        'kod_pj',
        'vazenje_paketa_do',
        'country_code',
    ];

    use Searchable;

    protected $indexConfigurator = PreduzecaIndexConfigurator::class;

    protected $searchRules = [
        //
    ];

    protected $mapping = [
        'properties' => [
            'kratki_naziv' => [
                'type' => 'text',
            ],
            'puni_naziv' => [
                'type' => 'text',
            ],
            'pib' => [
                'type' => 'text',
            ],
        ]
    ];

    public function scopeFilterByPermissions($query)
    {
        if (auth()->user()->hasRole('SuperAdmin')) {
            return $query;
        }

        // $query = $query->where('id', getAuthPreduzeceId(request()));

        return $query;

        // if (auth()->user()->can('view all Racun')) {
        //     return $query;
        // }

        // if (auth()->user()->can('view owned Racun')) {
        //     return $query->where('user_id', auth()->id());
        // }
    }

    public function toSearchableArray()
    {
        $array = $this->only('kratki_naziv', 'puni_naziv', 'pib');

        return $array;
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_tip_korisnika', 'preduzece_id', 'user_id');
    }

    public function fizickaLica()
    {
        return $this->hasMany('App\Models\FizickoLice', 'preduzece_id');
    }

    public function partneri()
    {
        return $this->hasOne('App\Models\Partner', 'preduzece_tabela_id');
    }

    public function ziro_racuni()
    {
        return $this->hasMany('App\Models\ZiroRacun', 'preduzece_id');
    }

    public function djelatnosti()
    {
        return $this->belongsToMany('App\Models\Djelatnost', 'preduzece_djelatnost', 'preduzece_id', 'djelatnost_id');
    }

    public function ovlascena_lica()
    {
        return $this->belongsToMany('App\Models\OvlascenoLice', 'ovlasceno_lice_preduzece', 'preduzece_id', 'ovlasceno_lice_id');
    }

    public function paketi()
    {
        return $this->belongsToMany('App\Models\Paket', 'paket_preduzece', 'preduzece_id', 'paket_id');
    }

    public function kategorija()
    {
        return $this->belongsTo('App\Models\Kategorija');
    }

    public function roba()
    {
        return $this->hasMany('App\Models\Roba', 'preduzece_id');
    }

    public function poslovne_jedinice()
    {
        return $this->hasMany('App\Models\PoslovnaJedinica', 'preduzece_id');
    }

    public function racuni()
    {
        return $this->hasMany('App\Models\Racun', 'preduzece_id');
    }

    public function dokumenti()
    {
        return $this->hasMany(Dokument::class);
    }

    public function podesavanje()
    {
        return $this->hasOne(Podesavanje::class);
    }

    public function setPecatAttribute($file)
    {
        //TODO: PUCALO ZBOG OVE PROVJERE VAZENJA

        // $this->attributes['vazenje_pecata_do'] = $this->getVazenjeDo(
        //     $file->get(),
        //     $this->attributes['pecatSifra']
        // );

        return $this->attributes['pecat'] = Storage::disk('local')
            ->putFileAs('certs', $file, Str::random(40) . '.pfx');
    }

    public function setSertifikatAttribute($file)
    {
        //TODO: PUCALO ZBOG OVE PROVJERE VAZENJA

        // $this->attributes['vazenje_sertifikata_do'] = $this->getVazenjeDo(
        //     $file->get(),
        //     $this->attributes['sertifikatSifra']
        // );

        return $this->attributes['sertifikat'] = Storage::disk('local')
            ->putFileAs('certs', $file, Str::random(40) . '.pfx');
    }

    public function getVazenjeDo($pecat, $sifra)
    {
        openssl_pkcs12_read($pecat, $key, decrypt($sifra));

        $cert = openssl_x509_parse($key['cert']);

        return date('Y-m-d H:i:s', $cert['validTo_time_t']);
    }

    public function getBrojUredjajaAttribute()
    {
        return $this->paketi->sum('broj_uredjaja');
    }

    public function getNajjaciPaketAttribute()
    {
        return $this->paketi->max('broj_uredjaja');
    }

    public function setLogotipAttribute($value)
    {
        if (!Storage::exists('public/logotipi')) {
            Storage::makeDirectory('public/logotipi');
        }

        if ($value->getClientOriginalExtension() === 'svg') {
            $this->attributes['logotip'] = Storage::disk('public')->putFile('logotipi', $value);
        } else {
            $name = Str::random(40);

            $directory = 'public/logotipi';

            $path = storage_path('app/' . $directory . '/' . $name . '.' . $value->getClientOriginalExtension());

            Image::make($value)->resize(800, 600)->save($path);

            $this->attributes['logotip'] = 'logotipi/' . $name . '.' . $value->getClientOriginalExtension();
        }
    }


    public function setThumbnailAttribute($value)
    {
        if (!Storage::exists('public/logotipi/thumbnails')) {
            Storage::makeDirectory('public/logotipi/thumbnails');
        }

        $extension = $value->getClientOriginalExtension();

        if ($extension === 'jpg' || $extension === 'png' || $extension === 'jpeg') {
            $name = Str::random(40);

            $directory = 'public/logotipi/thumbnails';

            $path24 = storage_path('app/' . $directory . '/' . $name . '_24x24.' . $extension);
            Image::make($value)->resize(24, 24)->save($path24);

            $path48 = storage_path('app/' . $directory . '/' . $name . '_48x48.' . $extension);
            Image::make($value)->resize(48, 48)->save($path48);

            $path200 = storage_path('app/' . $directory . '/' . $name . '_200x150.' . $extension);
            Image::make($value)->resize(200, 150)->save($path200);

            $path400 = storage_path('app/' . $directory . '/' . $name . '_400x300.' . $extension);
            Image::make($value)->resize(400, 300)->save($path400);

            $path = storage_path('app/' . $directory . '/' . $name . '.' . $extension);
            Image::make($value)->save($path);

            $this->attributes['thumbnail'] = 'logotipi/thumbnails/' . $name . '.' . $extension;
        }
    }
}
