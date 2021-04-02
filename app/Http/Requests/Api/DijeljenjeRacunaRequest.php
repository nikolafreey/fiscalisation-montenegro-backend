<?php

namespace App\Http\Requests\Api;

class DijeljenjeRacunaRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required'
        ];
    }
}
