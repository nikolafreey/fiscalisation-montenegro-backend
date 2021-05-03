<?php

namespace App\Http\Requests\Api;

class StorePartner extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kontakt_ime' => 'nullable|string|max:50|min:3',
            'kontakt_prezime' => 'nullable|string|max:50|min:3',
            'kontakt_telefon' => 'nullable|string|max:50|min:3',
            'kontakt_viber' => 'nullable|boolean',
            'kontakt_whatsapp' => 'nullable|boolean',
            'kontakt_facetime' => 'nullable|boolean',
            'opis' => 'nullable|string',
            'fizicko_lice_id' => 'nullable|exists:fizicka_lica,id',
            'preduzece_tabela_id' => 'nullable|exists:preduzeca,id',
            'pib' => 'nullable',
        ];
    }
}
