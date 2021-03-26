<?php

namespace App\Http\Requests\Api;

class StoreProizvodjacRobe extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'naziv' => 'required|string|max:50|min:3',
        ];
    }
}
