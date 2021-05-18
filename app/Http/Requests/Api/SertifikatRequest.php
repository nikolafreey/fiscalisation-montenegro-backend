<?php

namespace App\Http\Requests\Api;

use App\Rules\PecatRule;
use App\Rules\SertifikatRule;

class SertifikatRequest extends BaseApiRequest
{
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
            'pecat' => ['nullable', new PecatRule($this->pecatSifra)],
            'sertifikat' => ['nullable', new SertifikatRule($this->sertifikatSifra)],
        ];
    }
}
