<?php

namespace App\Http\Requests\Api;

class StoreRoba extends BaseApiRequest
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
            'opis' => 'nullable|string',
            'detaljni_opis' => 'nullable|string',
            'ean' => 'nullable|string',
            'interna_sifra_proizvoda' => 'nullable|string',
            'status' => 'nullable|boolean',
            'pdv_ukljucen' => 'nullable',
            'proizvodjac_robe_id' => 'nullable',
            'jedinica_mjere_id' => 'nullable',
            'cijena_bez_pdv' => 'nullable',
            'atribut_id' => 'nullable',
        ];
    }
}
