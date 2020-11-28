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
        return false;
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
            'ib' => 'required|string|size:8',
            'adresa' => 'required|string|max:191',
            'telefon' => 'required|string|max:191',
            'email' => 'required|string|max:191',
            'zanimanje' => 'required|string|max:191',
            'radno_mjesto' => 'required|string|max:50',
            'drzavljanstvo' => 'required|string|max:50',
            'nacionalnost' => 'required|string|max:50',
            'cv_link' => 'required|string|max:255',
            'avatar' => 'required|string|max:255',
            'preduzece_id' => 'required|exists:preduzeca,id'
        ];
    }
}
