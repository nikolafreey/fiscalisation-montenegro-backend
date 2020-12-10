<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoba extends FormRequest
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
            'opis' => 'nullable|string', 
            'detaljni_opis' => 'nullable|string', 
            'ean' => 'nullable|string', 
            'interna_sifra_proizvoda' => 'nullable|string', 
            'status' => 'nullable|boolean', 
            'proizvodjac_robe_id' => 'nullable', 
            'jedinica_mjere_id' => 'nullable',
        ];
    }
}
