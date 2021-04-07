<?php

namespace App\Http\Requests\Api\Podesavanja;

use App\Http\Requests\Api\BaseApiRequest;

class DodavanjeKorisnikaRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'puno_ime' => 'required',
            'email' => 'required',
            'preduzece_id' => 'required',
            'uloga' => 'required'
        ];
    }
}
