<?php

namespace Database\Factories;

use App\Models\Kategorija;
use App\Models\Preduzece;
use Illuminate\Database\Eloquent\Factories\Factory;

class PreduzeceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Preduzece::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kratki_naziv' => $this->faker->word(),
            'puni_naziv' => $this->faker->word(),
            'oblik_preduzeca' => $this->faker->word(),
            'adresa' => $this->faker->address(),
            'grad' => $this->faker->city(),
            'drzava' => $this->faker->country(),
            'telefon' => $this->faker->phoneNumber(),
            'telefon_viber' => $this->faker->boolean(),
            'telefon_whatsapp' => $this->faker->boolean(),
            'telefon_facetime' => $this->faker->boolean(),
            'fax' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail,
            'website' => $this->faker->word(),
            'pib' => $this->faker->unique()->randomDigit(),
            'pdv' => $this->faker->unique()->randomDigit(),
            'djelatnost' => $this->faker->word(),
            'iban' => $this->faker->unique()->word(),
            'bic_swift' => $this->faker->unique()->word(),
            'kontakt_prezime' => $this->faker->word(),
            'kontakt_telefon' => $this->faker->word(),
            'kontakt_viber' => $this->faker->boolean(),
            'kontakt_whatsapp' => $this->faker->boolean(),
            'kontakt_facetime' => $this->faker->boolean(),
            'kontakt_email' => $this->faker->unique()->safeEmail,
            'twitter_username' => $this->faker->userName,
            'instagram_username' => $this->faker->userName,
            'facebook_username' => $this->faker->userName,
            'skype_username' => $this->faker->userName,
            'logotip' => $this->faker->word(),
            'opis' => $this->faker->word(),
            'lokacija_lat' => $this->faker->word(),
            'lokacija_long' => $this->faker->word(),
            'status' => $this->faker->userName,
            'verifikovan' => $this->faker->userName,
            'privatnost' => $this->faker->userName,
            'kategorija_id' => Kategorija::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
