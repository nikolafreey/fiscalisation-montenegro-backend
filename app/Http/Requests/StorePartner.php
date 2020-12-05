<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartner extends FormRequest
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
            'kontakt_ime' => 'nullable|string|max:50|min:3',
            'kontakt_prezime' => 'nullable|string|max:50|min:3',
            'kontakt_telefon' => 'nullable|string|max:50|min:3',
            'kontakt_viber' => 'nullable|boolean',
            'kontakt_whatsapp' => 'nullable|boolean',
            'kontakt_facetime' => 'nullable|boolean',
            'opis' => 'nullable|string',
            'fizicko_lice_id' => 'nullable|int|max:20',
            'preduzece_id' => 'nullable|int|max:20',
        ];
    }
}
