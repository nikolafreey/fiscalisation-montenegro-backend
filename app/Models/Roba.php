<?php

namespace App\Models;

use App\RobaIndexConfigurator;
use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ScoutElastic\Searchable;
use App\Traits\ImaAktivnost;

class Roba extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $table = 'robe';

    protected $fillable = ['naziv', 'opis', 'detaljni_opis', 'ean', 'interna_sifra_proizvoda', 'status', 'proizvodjac_robe_id', 'jedinica_mjere_id'];

    use Searchable;

    protected $indexConfigurator = RobaIndexConfigurator::class;

    protected $searchRules = [
        //
    ];

    protected $mapping = [
        'properties' => [
            'naziv' => [
                'type' => 'text',
            ],
            'interna_sifra_proizvoda' => [
                'type' => 'text',
            ],
            'ean' => [
                'type' => 'text',
            ],
        ]
    ];

    // protected static function booted()
    // {
    //     static::addGlobalScope(new UserScope);
    // }

    public function toSearchableArray()
    {
        $array = $this->only('naziv');
        // $array = $this->only('naziv', 'interna_sifra_proizvoda');

        return $array;
    }


    public function storeKategorije($kategorije)
    {
        foreach ($kategorije as $kategorijaId => $podKategorije) {
            if (count($podKategorije) == 0) {
                $robaKategorijaPodkategorija[] = [
                    'roba_id' => $this->id,
                    'kategorija_robe_id' => $kategorijaId,
                    'podkategorija_robe_id' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            } else {
                foreach ($podKategorije as $podKategorijaId) {
                    $robaKategorijaPodkategorija[] = [
                        'roba_id' => $this->id,
                        'kategorija_robe_id' => $kategorijaId,
                        'podkategorija_robe_id' => $podKategorijaId,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                };
            }
        };

        RobaKategorijaPodKategorija::insert($robaKategorijaPodkategorija);
    }

    public function storeCijene($data, $preduzece_id)
    {
        $cijenaValues[] = [
            'nabavna_cijena_bez_pdv' => $data['nabavna_cijena_bez_pdv'],
            'nabavna_cijena_sa_pdv' => $data['nabavna_cijena_sa_pdv'],
            'cijena_bez_pdv' => $data['cijena_bez_pdv'],
            'ukupna_cijena' => $data['ukupna_cijena'],
            'porez_id' => $data['porez_id'],
            'roba_id' => $this->id,
            'atribut_id' => 1,
            'user_id' => auth()->id(),
            'preduzece_id' => $preduzece_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $porezStopa = Porez::find($data['porez_id']);
        foreach ($data['cijene'] as $cijena) {
            foreach ($cijena['atribut_id'] as $atribut_id) {
                $cijenaValues[] = [
                    'nabavna_cijena_bez_pdv' => $data['nabavna_cijena_bez_pdv'],
                    'nabavna_cijena_sa_pdv' => $data['nabavna_cijena_sa_pdv'],
                    'cijena_bez_pdv' => $data['pdv_ukljucen'] == 1 ? $cijena['ukupna_cijena'] / (1 + $porezStopa->stopa) : $cijena['ukupna_cijena'],
                    'ukupna_cijena' => $data['pdv_ukljucen'] == 0 ? $cijena['ukupna_cijena'] + $cijena['ukupna_cijena'] * $porezStopa->stopa :  $cijena['ukupna_cijena'],
                    'porez_id' => $data["porez_id"],
                    'roba_id' => $this->id,
                    'preduzece_id' => $preduzece_id,
                    'user_id' => auth()->id(),
                    'atribut_id' => $atribut_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
        }

        CijenaRobe::insert($cijenaValues);
    }

    public static function filter(Request $request)
    {
        if ($request->has('search')) {
            $query = Roba::search($request->search . '*');
        } else {
            $query = Roba::query();
        }
        if ($request->has('atribut_id')) {
            $query = $query->where('atribut_id', $request->atribut_id);
        }
        return $query;
    }

    public function storeAtributi($atributi)
    {
        $this->atributi_roba()->sync($atributi);
    }

    public function proizvodjac_robe()
    {
        return $this->belongsTo('App\Models\ProizvodjacRobe', 'proizvodjac_robe_id');
    }

    public function jedinica_mjere()
    {
        return $this->belongsTo('App\Models\JedinicaMjere', 'jedinica_mjere_id');
    }

    public function preduzece()
    {
        return $this->hasMany('App\Models\Preduzece', 'preduzece_id');
    }

    public function robe_kategorije()
    {
        return $this->belongsToMany('App\Models\Kategorija', 'robe_kategorije_podkategorije', 'roba_id', 'kategorija_robe_id');
    }

    public function cijene_roba()
    {
        return $this->hasMany('App\Models\CijenaRobe', 'roba_id');
    }

    public function tipovi_atributa()
    {
        return $this->belongsToMany('App\Models\TipAtributa', 'tipovi_atributa_roba', 'roba_id', 'tipovi_atributa_roba_id');
    }
    public function robe_kategorije_podkategorije()
    {
        return $this->hasMany('App\Models\RobaKategorijaPodKategorija', 'roba_id');
    }

    public function atributi_roba()
    {
        return $this->belongsToMany('App\Models\AtributRobe', 'robe_atributi_roba', 'roba_id', 'atribut_id');
    }
}
