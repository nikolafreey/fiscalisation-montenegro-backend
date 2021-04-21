<?php

namespace App\Http\Requests\Api;

class StorePoslovnaJedinica extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kratki_naziv' => 'required|string|max:50|min:3',
            'adresa' => 'required|string|max:50|min:3',
            'grad' => 'required|string|max:50|min:3',
            'drzava' => 'required|string|max:50|min:3',
            'kod_poslovnog_prostora' => 'nullable',
        ];
    }
}
