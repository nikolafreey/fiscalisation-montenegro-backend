<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePreduzece extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'pecatSifra' => encrypt($this->pecatSifra),
            'sertifikatSifra' => encrypt($this->sertifikatSifra),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pecatSifra' => 'nullable',
            'sertifikatSifra' => 'nullable',
            'pecat' => 'required_without:sertifikat',
            'sertifikat' => 'required_without:pecat',
            'pib' => 'nullable',
            'software_kod' => 'nullable',
            'enu_kod' => 'nullable',
        ];
    }
}
