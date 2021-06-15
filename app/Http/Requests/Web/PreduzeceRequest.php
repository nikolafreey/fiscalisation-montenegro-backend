<?php

namespace App\Http\Requests\Web;

use App\Rules\PecatRule;
use App\Rules\SertifikatRule;
use Illuminate\Foundation\Http\FormRequest;

class PreduzeceRequest extends FormRequest
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
            'pecatSifra' => $this->pecatSifra != null ? encrypt($this->pecatSifra) : null,
            'sertifikatSifra' => $this->sertifikatSifra != null ? encrypt($this->sertifikatSifra) : null,
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
            'kratki_naziv' => 'required|string|max:100',
            'oblik_preduzeca' => 'required|string|max:50',
            'adresa' => 'required|string|max:50',
            'grad' => 'required|string|max:50',
            'drzava' => 'required|string|max:50',
            'pib' => 'required|string|max:50|min:7',
            'pdv' => 'required|string|max:50',
            'enu_kod' => 'nullable',
            'kod_operatera' => 'nullable',
            'kategorija_id' => 'required|int',
            'djelatnost_id' => 'required|int',
            'user_id' => 'nullable',
            'pecatSifra' => 'nullable',
            'sertifikatSifra' => 'nullable',
            'pecat' => ['nullable', new PecatRule($this->pecatSifra)],
            'sertifikat' => ['nullable', new SertifikatRule($this->sertifikatSifra)],
        ];
    }
}
