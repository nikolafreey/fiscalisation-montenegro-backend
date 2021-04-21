<?php

namespace App\Http\Requests\Api;

class StoreRacun extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'ikof' => 'nullable',
            'jikr' => 'nullable',
            'qr_url' => 'nullable',
            'tip_racuna' => 'nullable',
            'vrsta_racuna' => 'nullable',
            'korektivni_racun' => 'nullable',
            'korektivni_racun_vrsta' => 'nullable',
            'nacin_placanja' => 'nullable',
            'broj_racuna' => 'nullable',
            'datum_za_placanje' => 'nullable',
            'kod_poslovnog_prostora_enu' => 'nullable',
            'ukupna_cijena_bez_pdv' => 'nullable',
            'ukupna_cijena_sa_pdv' => 'nullable',
            'ukupan_iznos_pdv' => 'nullable',
            'popust_procenat' => 'nullable',
            'popust_iznos' => 'nullable',
            'popust_na_cijenu_bez_pdv' => 'nullable',
            'popust_ukupno' => 'nullable',
            'opis' => 'nullable',
            'status' => 'nullable',
            'partner_id' => 'nullable',
        ];
    }
}
