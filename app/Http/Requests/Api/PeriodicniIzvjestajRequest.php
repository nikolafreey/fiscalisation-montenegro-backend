<?php

namespace App\Http\Requests\Api;

class PeriodicniIzvjestajRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'datum_od' => 'required',
            'datum_do' => 'required',
        ];
    }
}
