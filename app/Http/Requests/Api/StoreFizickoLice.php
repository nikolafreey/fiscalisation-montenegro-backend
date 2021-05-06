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
            'ib' => 'nullable|string|size:8',
            'adresa' => 'nullable|string|max:191',
            'grad' => 'string|max:191',
            'drzava' => 'nullable|string|max:191',
            'status' => 'boolean',
            'telefon' => 'nullable|string|max:191',
            'telefon_viber' => 'boolean',
            'telefon_whatsapp' => 'boolean',
            'telefon_facetime' => 'boolean',
            'email' => 'nullable|email',
            'zanimanje' => 'nullable|string|max:191',
            'radno_mjesto' => 'nullable|string|max:50',
            'drzavljanstvo' => 'nullable|string|max:50',
            'nacionalnost' => 'nullable|string|max:50',
            'cv_link' => 'nullable|string|max:255',
            'avatar' => 'nullable|string|max:255',
        ];
    }
}
