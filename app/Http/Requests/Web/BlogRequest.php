<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'naziv' => 'required',
            'slika' => ($this->method() === 'POST' ? 'required' : 'nullable') . '|string',
            'tekst' => 'required',
            'blog_category_id' => 'required',
        ];
    }
}
