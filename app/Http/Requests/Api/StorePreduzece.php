<?php

namespace App\Http\Requests\Api;

class StorePreduzece extends BaseApiRequest
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
            'country_code' => 'nullable',
            'telefon' => 'string|max:50|nullable',
            'telefon_viber' => 'nullable',
            'telefon_whatsapp' => 'nullable',
            'telefon_facetime' => 'nullable',
            'fax' => 'string|max:50|nullable',
            'email' => 'string|email|nullable',
            'website' => 'string|max:191|nullable',
            'pib' => 'nullable|max:50|min:8',
            'pdv' => 'nullable|string|max:50',
            'iban' => 'string|max:50|nullable',
            'bic_swift' => 'string|max:50|nullable',
            'kontakt_ime' => 'string|max:50|nullable',
            'kontakt_prezime' => 'string|max:50|nullable',
            'kontakt_telefon' => 'string|max:50|nullable',
            'kontakt_viber' => 'nullable',
            'kontakt_whatsapp' => 'nullable',
            'kontakt_facetime' => 'nullable',
            'kontakt_email' => 'nullable',
            'twitter_username' => 'nullable',
            'instagram_username' => 'nullable',
            'facebook_username' => 'nullable',
            'logotip' => 'nullable',
            'thumbnail' => 'nullable',
            'opis' => 'string|max:255|nullable',
            'lokacija_lat' => 'string|max:255|nullable',
            'lokacija_long' => 'string|max:255|nullable',
            'status' => 'nullable',
            'privatnost' => 'nullable',
            'verifikovan' => 'nullable',
            'pdv_obveznik' => 'nullable',
            'kategorija_id' => 'required|int',
            'djelatnost_id' => 'required|int'
        ];
    }
}
