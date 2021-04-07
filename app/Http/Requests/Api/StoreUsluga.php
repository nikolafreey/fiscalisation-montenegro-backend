<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsluga extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'naziv' => 'required|string|max:50|min:3',
            'opis' => 'string|max:255|min:3',
            'cijena_bez_pdv' => array('regex:/^-?[0-9]+(?:\.[0-9]{1,4})?$/', 'min:1', 'max:15'),
            'ukupna_cijena' => array('regex:/^-?[0-9]+(?:\.[0-9]{1,4})?$/', 'min:1', 'max:15'),
            'cijena_bez_pdv_popust' => array('regex:/^-?[0-9]+(?:\.[0-9]{1,4})?$/', 'min:1', 'max:15'),
            'cijena_sa_pdv_popust' => array('regex:/^-?[0-9]+(?:\.[0-9]{1,4})?$/', 'min:1', 'max:15'),
            'grupa_id' => 'int',
            'status' => 'boolean',
            'jedinica_mjere_id' => 'int',
            'porez_id' => 'int',
        ];
    }
}
