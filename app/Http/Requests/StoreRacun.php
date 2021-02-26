<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreRacun extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
            // 'preduzece_id' => 'required',
        ];
    }
}
