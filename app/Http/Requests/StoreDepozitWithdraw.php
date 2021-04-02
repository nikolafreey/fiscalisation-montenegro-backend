<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepozitWithdraw extends FormRequest
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
            'iznos_depozit' => 'required_without:iznos_withdraw',
            'iznos_withdraw' => 'required_without:iznos_depozit',
            'poslovna_jedinica_id' => 'required|int',
            // 'preduzece_id ' => 'required',
            // 'user_id ' => 'required'
        ];
    }
}
