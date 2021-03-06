<?php

namespace App\Http\Requests\Api\Upload;

use App\Http\Requests\Api\BaseApiRequest;

class UploadAvataraKorisnikaRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => 'required'
        ];
    }
}
