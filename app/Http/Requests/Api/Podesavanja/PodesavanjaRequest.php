<?php

namespace App\Http\Requests\Api\Podesavanja;

use App\Http\Requests\Api\BaseApiRequest;

class PodesavanjaRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'redni_broj' => 'required',
            'slanje_kupcu' => 'required',
            'izgled_racuna' => 'required',
            'boja' => 'nullable',
            'tamni_mod' => 'required',
            'jezik' => 'required',
            'pecat' => 'nullable',
            'sertifikat' => 'nullable',
            'sertifikat_sifra' => 'nullable',
            'pecat_sifra' => 'nullable',
            'enu_kod' => 'nullable',
            'software_kod' => 'nullable',
            'kod_pj' => 'nullable',
            'kod_operatera' => 'nullable',
        ];
    }
}
