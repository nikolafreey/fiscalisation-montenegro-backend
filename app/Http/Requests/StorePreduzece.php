<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePreduzece extends FormRequest
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
            'kratki_naziv' => 'required|string|max:50|min:3',
            'puni_naziv' => 'string|max:100|min:3',
            'oblik_preduzeca' => 'required|string|max:50|min:3',
            'adresa' => 'string|max:50|min:3',
            'grad' => 'string|max:50|min:3',
            'drzava' => 'string|max:50|min:3',
            'telefon' => 'required|string|max:50|min:3',
            'telfon_viber' => 'boolean',
            'telfon_whatsapp' => 'boolean',
            'telfon_facetime' => 'boolean',
            'fax' => 'string|max:50|min:3',
            'email' => 'string|email',
            'website' => 'string|max:191|min:3',
            'pib' => 'require|string|max:50|min:3',
            'pdv' => 'require|string|max:50|min:3',
            'iban' => 'string|max:50|min:3',
            'bic_swift' => 'string|max:50|min:3',
            'kontakt_ime' => 'string|max:50|min:3',
            'kontakt_prezime' => 'string|max:50|min:3',
            'kontakt_telefon' => 'string|max:50|min:3',
            'kontakt_viber' => 'boolean',
            'kontakt_whatsapp' => 'boolean',
            'kontakt_facetime' => 'boolean',
            'kontakt_email' => 'string|max:191|min:3',
            'twitter_username ' => 'string|max:100|min:3',
            'instagram_username ' => 'string|max:100|min:3',
            'facebook_username ' => 'string|max:100|min:3',
            'logotip ' => 'string|max:255|min:3',
            'opis ' => 'required|string|max:255|min:3',
            'lokacija_lat ' => 'string|max:50|min:3',
            'lokacija_long ' => 'string|max:50|min:3',
            'status ' => 'boolean',
            'privatnost ' => 'boolean',
            'verifikovan ' => 'boolean',
            'kategorija_id ' => 'required|int',
        ];
    }
}
