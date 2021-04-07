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
            'redni_broj' => 'nullable',
            'slanje_kupcu' => 'nullable',
            'izgled_racuna' => 'nullable',
            'boja' => 'nullable',
            'mod' => 'nullable',
            'jezik' => 'nullable',
            'user_id' => 'required',
            'preduzece_id' => 'required',
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
