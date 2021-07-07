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
            'pib' => 'nullable|max:50|min:8|nullable',
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
            'opis' => 'nullable',
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

    protected function prepareForValidation()
    {
        $this->merge([
            'kratki_naziv' => $this->kratki_naziv === "null" ? null : $this->kratki_naziv,
            'puni_naziv' => $this->puni_naziv === "null" ? null : $this->puni_naziv,
            'oblik_preduzeca' => $this->oblik_preduzeca === "null" ? null : $this->oblik_preduzeca,
            'adresa' => $this->adresa === "null" ? null : $this->adresa,
            'grad' => $this->grad === "null" ? null : $this->grad,
            'drzava' => $this->drzava === "null" ? null : $this->drzava,
            'country_code' => $this->country_code === "null" ? null : $this->country_code,
            'telefon' => $this->telefon === "null" ? null : $this->telefon,
            'telefon_viber' => $this->telefon_viber === "null" ? null : $this->telefon_viber,
            'telefon_whatsapp' => $this->telefon_whatsapp === "null" ? null : $this->telefon_whatsapp,
            'telefon_facetime' => $this->telefon_facetime === "null" ? null : $this->telefon_facetime,
            'fax' => $this->fax === "null" ? null : $this->fax,
            'email' => $this->email === "null" ? null : $this->email,
            'website' => $this->website === "null" ? null : $this->website,
            'pib' => $this->pib === "null" ? null : $this->pib,
            'pdv' => $this->pdv === "null" ? null : $this->pdv,
            'iban' => $this->iban === "null" ? null : $this->iban,
            'bic_swift' => $this->bic_swift === "null" ? null : $this->bic_swift,
            'kontakt_ime' => $this->kontakt_ime === "null" ? null : $this->kontakt_ime,
            'kontakt_prezime' => $this->kontakt_prezime === "null" ? null : $this->kontakt_prezime,
            'kontakt_telefon' => $this->kontakt_telefon === "null" ? null : $this->kontakt_telefon,
            'kontakt_viber' => $this->kontakt_viber === "null" ? null : $this->kontakt_viber,
            'kontakt_whatsapp' => $this->kontakt_whatsapp === "null" ? null : $this->kontakt_whatsapp,
            'kontakt_facetime' => $this->kontakt_facetime === "null" ? null : $this->kontakt_facetime,
            'kontakt_email' => $this->kontakt_email === "null" ? null : $this->kontakt_email,
            'twitter_username' => $this->twitter_username === "null" ? null : $this->twitter_username,
            'facebook_username' => $this->kontakt_email === "null" ? null : $this->kontakt_email,
            'instagram_username' => $this->kontakt_email === "null" ? null : $this->kontakt_email,
            'logotip' => $this->logotip === "null" ? null : $this->logotip,
            'thumbnail' => $this->thumbnail === "null" ? null : $this->thumbnail,
            'opis' => $this->opis === "null" ? null : $this->opis,
            'lokacija_lat' => $this->lokacija_lat === "null" ? null : $this->lokacija_lat,
            'lokacija_long' => $this->lokacija_long === "null" ? null : $this->lokacija_long,
            'status' => $this->status === "null" ? null : $this->status,
            'privatnost' => $this->privatnost === "null" ? null : $this->privatnost,
            'pdv_obveznik' => $this->pdv_obveznik === "null" ? null : $this->pdv_obveznik,
            'kategorija_id' => $this->kategorija_id === "null" ? null : $this->kategorija_id,
            'djelatnost_id' => $this->djelatnost_id === "null" ? null : $this->djelatnost_id,
        ]);
    }
}
