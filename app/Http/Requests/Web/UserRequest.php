<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'password' => empty($this->input('password')) ? Str::random(40) : $this->input('password')
        ]);
    }

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
