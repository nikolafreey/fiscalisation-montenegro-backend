<?php

namespace App\Http\Requests\Api;

class StoreKategorijaDokumenta extends BaseApiRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'preduzece_id' => getAuthPreduzeceId(request()),
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
            'naziv' => 'required',
            'preduzece_id' => 'nullable',
        ];
    }
}
