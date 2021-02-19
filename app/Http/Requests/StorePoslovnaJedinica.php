<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePoslovnaJedinica extends FormRequest
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
            'adresa' => 'required|string|max:50|min:3',
            'grad' => 'required|string|max:50|min:3',
            'drzava' => 'required|string|max:50|min:3',
            'preduzece_id ' => 'required|int',
            'user_id ' => 'required|int'
        ];
    }
}
