<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFizickoLice extends FormRequest
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
            'ime' => 'required|string|max:50|min:3',
            'prezime' => 'required|string|max:50|min:3',
            'jmbg' => 'required|string|size:13',
            'ib' => 'string|size:8',
            'adresa' => 'string|max:191',
            'telefon' => 'string|max:191',
            'email' => 'required|string|max:191',
            'zanimanje' => 'string|max:191',
            'radno_mjesto' => 'string|max:50',
            'drzavljanstvo' => 'string|max:50',
            'nacionalnost' => 'string|max:50',
            'cv_link' => 'string|max:255',
            'avatar' => 'string|max:255',
            'preduzece_id' => 'required|exists:preduzeca,id'
        ];
    }
}
