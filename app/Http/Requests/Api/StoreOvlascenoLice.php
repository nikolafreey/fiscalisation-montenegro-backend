<?php

namespace App\Http\Requests\Api;

class StoreOvlascenoLice extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ime' => 'required|string|max:50|min:3',
            'prezime' => 'required|string|max:50|min:3',
            'email' => 'required|email',
        ];
    }
}
