<?php

namespace App\Http\Requests\Api;

class StoreZiroRacun extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'broj_racuna' => 'required|string|max:50|min:3',
        ];
    }
}
