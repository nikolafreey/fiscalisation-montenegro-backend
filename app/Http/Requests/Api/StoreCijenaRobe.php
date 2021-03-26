<?php

namespace App\Http\Requests\Api;

class StoreCijenaRobe extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'porezi_id' => 'required|int',
            'roba_id' => 'required|int',
            'atribut_id' => 'int',
            'cijena_bez_pdv' => array('regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/', 'min:1', 'max:15'),
            'ukupna_cijena' => array('regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/', 'min:1', 'max:15'),
        ];
    }
}
