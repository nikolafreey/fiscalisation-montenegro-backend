<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsluga extends FormRequest
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
            'naziv' => 'required|string|max:50|min:3',
            'opis' => 'string|max:255|min:3',
            'cijena_bez_pdv' => 'required',//array('regex:/^(?:d*.d{1,2}|d+)$/', 'min:1', 'max:15'),
            'pdv_iznos' => 'required',//array('regex:/^(?:d*.d{1,2}|d+)$/', 'min:1', 'max:15'),
            'ukupna_cijena' => 'required',//array('regex:/^(?:d*.d{1,2}|d+)$/', 'min:1', 'max:15'),
            'status' => 'nullable|boolean',
            'grupa_id' => 'nullable|int|max:20',
            'jedinica_mjere_id' => 'nullable|int|max:20',
            'porez_id' => 'nullable|int|max:20',
        ];
    }
}
