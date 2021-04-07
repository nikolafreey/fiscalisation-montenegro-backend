<?php

namespace App\Http\Requests\Api;

class OdaberiPreduzeceRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'preduzece_id' => 'required',
        ];
    }
}
