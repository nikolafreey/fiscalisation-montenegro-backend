<?php

namespace App\Http\Requests\Api;

class StoreFizickoLice extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ime' => 'required|string|max:50|min:3',
            'prezime' => 'required|string|max:50|min:3',
            'jmbg' => 'required|string|size:13',
            'ib' => 'string|size:8',
            'adresa' => 'string|max:191',
            'grad' => 'string|max:191',
            'drzava' => 'string|max:191',
            'status' => 'boolean',
            'telefon' => 'string|max:191',
            'telefon_viber' => 'boolean',
            'telefon_whatsapp' => 'boolean',
            'telefon_facetime' => 'boolean',
            'email' => 'required|email',
            'zanimanje' => 'string|max:191',
            'radno_mjesto' => 'string|max:50',
            'drzavljanstvo' => 'string|max:50',
            'nacionalnost' => 'string|max:50',
            'cv_link' => 'string|max:255',
            'avatar' => 'string|max:255',
        ];
    }
}
