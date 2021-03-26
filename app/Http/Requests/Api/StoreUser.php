<?php

namespace App\Http\Requests\Api;

class StoreUser extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ime' => 'nullable',
            'prezime' => 'nullable',
            'avatar' => 'nullable',
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
}
