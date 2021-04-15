<?php

namespace App\Http\Requests\Api;

class StoreAtributRobe extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'naziv' => 'required|string|max:50',
            'tip_atributa_id' => 'required|int',
        ];
    }
}
