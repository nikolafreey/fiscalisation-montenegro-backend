<?php

namespace App\Http\Requests\Api;

class StoreUlazniRacun extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kod_operatera' => 'nullable',
            'kod_poslovnog_prostora' => 'nullable',
            'ikof' => 'nullable',
            'jikr' => 'nullable',
            'tip_racuna' => 'required',
            'vrsta_racuna' => 'required',
            'korektivni_racun' => 'required',
            'korektivni_racun_vrsta' => 'nullable',
            'broj_racuna' => 'required',
            'datum_izdavanja' => 'required',
            'datum_za_placanje' => 'nullable',
            'kod_poslovnog_prostora_enu' => 'nullable',
            'ukupna_cijena_bez_pdv' => 'required',
            'ukupna_cijena_sa_pdv' => 'required',
            'ukupan_iznos_pdv' => 'required',
            'popust_procenat' => 'nullable',
            'popust_iznos' => 'nullable',
            'popust_na_cijenu_bez_pdv' => 'nullable',
            'popust_ukupno' => 'nullable',
            'opis' => 'nullable',
            'status' => 'required',
        ];
    }
}
