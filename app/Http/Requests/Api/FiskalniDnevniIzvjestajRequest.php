<?php

namespace App\Http\Requests\Api;

class FiskalniDnevniIzvjestajRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'poslovna_jedinica_id' => 'required',
            'datum' => 'required'
        ];
    }
}