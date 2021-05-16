<?php

namespace App\Http\Requests\Web;

use App\Rules\PecatRule;
use App\Rules\SertifikatRule;
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
            'pecatSifra' => 'nullable',
            'sertifikatSifra' => 'nullable',
            'pecat' => ['required_without:sertifikat', new PecatRule($this->pecatSifra)],
            'sertifikat' => ['required_without:pecat', new SertifikatRule($this->sertifikatSifra)],
            'pib' => 'nullable',
            'enu_kod' => 'nullable',
            'kod_operatera' => 'nullable',
        ];
    }
}
