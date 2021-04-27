<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SertifikatRule implements Rule
{
    /**
     * @var string
     */
    private $sertifikatSifra;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($sertifikatSifra)
    {
        $this->sertifikatSifra = $sertifikatSifra;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        openssl_pkcs12_read($value->get(), $key, decrypt($this->sertifikatSifra));

        return (bool) $key;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sertifikat nije validan.';
    }
}
