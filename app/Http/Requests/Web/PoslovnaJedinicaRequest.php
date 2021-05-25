<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class PoslovnaJedinicaRequest extends FormRequest
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
            'kratki_naziv' => 'required',
            'adresa' => 'required',
            'grad' => 'required',
            'drzava' => 'required',
            'kod_poslovnog_prostora' => 'required',
            'preduzece_id' => 'required',
            'user_id' => 'required',
        ];
    }
}
