<?php

namespace App\Http\Requests\Api;

class StoreKategorijaDokumenta extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'naziv' => 'required'
        ];
    }
}
