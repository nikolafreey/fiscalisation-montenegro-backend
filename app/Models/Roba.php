<?php

namespace App\Models;

use App\RobaIndexConfigurator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use ScoutElastic\Searchable;

class Roba extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'robe';

    protected $fillable = ['naziv', 'opis', 'detaljni_opis', 'ean', 'interna_sifra_proizvoda', 'status', 'proizvodjac_robe_id', 'jedinica_mjere_id', 'preduzece_id'];

<<<<<<< HEAD
    // use Searchable;
=======
    //use Searchable;
>>>>>>> b9e1125a7020b24c910cef5351a3d488c5f302fa

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
        ]
    ];

    public function toSearchableArray()
    {
        $array = $this->only('naziv', 'interna_sifra_proizvoda');

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

    public function storeCijene($data)
    {
        $cijenaValues[] = [
            'nabavna_cijena_bez_pdv' => $data['nabavna_cijena_bez_pdv'],
            'nabavna_cijena_sa_pdv' => $data['nabavna_cijena_sa_pdv'],
            'cijena_bez_pdv' => 2,
            'ukupna_cijena' => $data['ukupna_cijena'],
            'porez_id' => $data['porez_id'],
            'roba_id' => $this->id,
            'atribut_id' => 1,
            'user_id' => auth()->id(),

            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        foreach ($data['cijene'] as $cijena) {
            foreach ($cijena['atribut_id'] as $atribut_id) {
                $cijenaValues[] = [
                    'nabavna_cijena_bez_pdv' => $data['nabavna_cijena_bez_pdv'],
                    'nabavna_cijena_sa_pdv' => $data['nabavna_cijena_sa_pdv'],
                    'cijena_bez_pdv' => 2,
                    'ukupna_cijena' => $cijena['ukupna_cijena'],
                    'porez_id' => $data->porez_id,
                    'roba_id' => $this->id,
                    'atribut_id' => $atribut_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
        }



        CijenaRobe::insert($cijenaValues);
    }


    public function storeAtributi($atributi)
    {
        $this->atributi_roba()->sync($atributi);
    }

    public function proizvodjac_robe()
    {
        return $this->hasOne('App\Models\ProizvodjacRobe', 'id');
    }

    public function jedinica_mjere()
    {
        return $this->hasOne('App\Models\JedinicaMjere', 'id');
    }

    public function preduzece()
    {
        return $this->hasMany('App\Models\Preduzece', 'preduzece_id');
    }

    public function robe_kategorije()
    {
        return $this->belongsToMany('App\Models\Kategorija', 'robe_kategorije', 'roba_id', 'kategorija_id');
    }

    public function cijene_roba()
    {
        return $this->hasMany('App\Models\CijenaRobe', 'roba_id');
    }

    public function tipovi_atributa()
    {
        return $this->belongsToMany('App\Models\TipAtributa', 'robe_tipovi_atributa', 'roba_id', 'tipovi_atributa_roba_id');
    }
    public function robe_kateogorije_podkategorije()
    {
        return $this->hasMany('App\Models\RobaKategorijaPodKategorija', 'roba_id');
    }

    public function atributi_roba()
    {
        return $this->belongsToMany('App\Models\AtributRobe', 'robe_atributi_roba', 'roba_id', 'atribut_id');
    }
}
