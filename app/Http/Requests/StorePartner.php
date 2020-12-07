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
            'kontakt_ime' => 'required|string|max:50|min:3',
            'kontakt_prezime' => 'required|string|max:50|min:3',
            'kontakt_telefon' => 'string|max:50|min:3',
            'kontakt_viber' => 'boolean',
            'kontakt_whatsapp' => 'boolean',
            'kontakt_facetime' => 'boolean',
            'opis' => 'string',
            'fizicko_lice_id' => 'int',
            'preduzece_id' => 'int',
        ];
    }
}
