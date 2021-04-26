<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PecatRule implements Rule
{
    private $pecatSifra;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($pecatSifra)
    {
        $this->pecatSifra = $pecatSifra;
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
        openssl_pkcs12_read($value->get(), $key, decrypt($this->pecatSifra));

        return (bool) $key;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Pecat nije validan.';
    }
}
