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
            'kratki_naziv' => 'nullable|string|max:100',
            'puni_naziv' => 'string|max:191',
            'oblik_preduzeca' => 'nullable|string|max:50',
            'adresa' => 'nullable|string|max:50',
            'grad' => 'nullable|string|max:50',
            'drzava' => 'nullable|string|max:50',
            'telefon' => 'string|max:50',
            'telfon_viber' => 'boolean',
            'telfon_whatsapp' => 'boolean',
            'telfon_facetime' => 'boolean',
            'fax' => 'string|max:50',
            'email' => 'string|email',
            'website' => 'string|max:191',
            'pib' => 'nullable|string|max:50|min:7',
            'pdv' => 'nullable|string|max:50',
            'iban' => 'string|max:50',
            'bic_swift' => 'string|max:50',
            'kontakt_ime' => 'string|max:50',
            'kontakt_prezime' => 'string|max:50',
            'kontakt_telefon' => 'string|max:50',
            'kontakt_viber' => 'boolean',
            'kontakt_whatsapp' => 'boolean',
            'kontakt_facetime' => 'boolean',
            'kontakt_email' => 'nullable',
            'twitter_username' => 'nullable',
            'instagram_username' => 'nullable',
            'facebook_username' => 'nullable',
            'logotip' => 'nullable',
            'thumbnail' => 'nullable',
            'opis' => 'string|max:255',
            'lokacija_lat' => 'string|max:255',
            'lokacija_long' => 'string|max:255',
            'status' => 'boolean',
            'privatnost' => 'boolean',
            'verifikovan' => 'boolean',
            'kategorija_id' => 'nullable|int',
            'djelatnost_id' => 'nullable|int'
        ];
    }
}
