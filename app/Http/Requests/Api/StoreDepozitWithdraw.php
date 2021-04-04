<?php

namespace App\Http\Requests\Api;

class StoreDepozitWithdraw extends BaseApiRequest
{
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
            'preduzece_id' => 'required|string',
            'user_id' => 'required|string'
        ];
    }
}
