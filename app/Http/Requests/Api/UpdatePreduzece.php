<?php

namespace App\Http\Requests\Api;

class UpdatePreduzece extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kratki_naziv' => 'required|string|max:100',
            'puni_naziv' => 'string|max:191|nullable',
            'oblik_preduzeca' => 'required|string|max:50',
            'adresa' => 'required|string|max:50',
            'grad' => 'required|string|max:50',
            'drzava' => 'required|string|max:50',
            'telefon' => 'string|max:50|nullable',
            'telfon_viber' => 'boolean',
            'telfon_whatsapp' => 'boolean',
            'telfon_facetime' => 'boolean',
            'fax' => 'string|max:50|nullable',
            'email' => 'string|email|nullable',
            'website' => 'string|max:191|nullable',
            'pib' => 'required|string|max:50|min:7',
            'pdv' => 'string|max:50|nullable',
            'iban' => 'string|max:50|nullable',
            'bic_swift' => 'string|max:50|nullable',
            'kontakt_ime' => 'string|max:50|nullable',
            'kontakt_prezime' => 'string|max:50|nullable',
            'kontakt_telefon' => 'string|max:50|nullable',
            'kontakt_viber' => 'boolean|nullable',
            'kontakt_whatsapp' => 'boolean|nullable',
            'kontakt_facetime' => 'boolean|nullable',
            'kontakt_email' => 'nullable|nullable',
            'twitter_username' => 'nullable',
            'instagram_username' => 'nullable',
            'facebook_username' => 'nullable',
            'logotip' => 'nullable',
            'thumbnail' => 'nullable',
            'opis' => 'string|max:255|nullable',
            'lokacija_lat' => 'string|max:255|nullable',
            'lokacija_long' => 'string|max:255|nullable',
            'status' => 'boolean',
            'privatnost' => 'boolean',
            'verifikovan' => 'boolean',
            'kategorija_id' => 'required|int',
            'djelatnost_id' => 'required|int'
        ];
    }
}
