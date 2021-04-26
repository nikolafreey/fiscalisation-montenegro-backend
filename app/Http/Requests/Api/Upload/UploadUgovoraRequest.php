<?php

namespace App\Http\Requests\Api\Upload;

use App\Http\Requests\Api\BaseApiRequest;

class UploadUgovoraRequest extends BaseApiRequest
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
            'file' => 'required',
            'preduzece_id' => 'nullable',
        ];
    }
}
