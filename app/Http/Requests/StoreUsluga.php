<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsluga extends FormRequest
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
            'naziv' => 'required|string|max:50|min:3',
            'opis' => 'string|max:255|min:3',
            'cijena_bez_pdv' => array('regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/', 'min:1', 'max:15'),
            'pdv_iznos' => array('regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/', 'min:1', 'max:15'),
            'ukupna_cijena' => array('regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/', 'min:1', 'max:15'),
            'grupa_id ' => 'int',
            'jedinica_mjere_id' => 'int',
            'porez_id ' => 'int',
        ];
    }
}
