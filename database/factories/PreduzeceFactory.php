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
            'kratki_naziv' => $this->faker->unique()->word(),
            'puni_naziv' => $this->faker->word(),
            'oblik_preduzeca' => $this->faker->word(),
            'adresa' => $this->faker->streetAddress(),
            'grad' => $this->faker->city(),
            'drzava' => $this->faker->country(),
            'telefon' => $this->faker->phoneNumber(),
            'telefon_viber' => $this->faker->boolean(),
            'telefon_whatsapp' => $this->faker->boolean(),
            'telefon_facetime' => $this->faker->boolean(),
            'fax' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail,
            'website' => $this->faker->word(),
            'pib' => $this->faker->unique()->randomNumber(),
            'pdv' => $this->faker->unique()->randomNumber(),
            'djelatnost' => $this->faker->word(),
            'iban' => $this->faker->unique()->randomNumber(),
            'bic_swift' => $this->faker->unique()->randomNumber(),
            'kontakt_ime' => $this->faker->word(),
            'kontakt_prezime' => $this->faker->word(),
            'kontakt_telefon' => $this->faker->word(),
            'kontakt_viber' => $this->faker->boolean(),
            'kontakt_whatsapp' => $this->faker->boolean(),
            'kontakt_facetime' => $this->faker->boolean(),
            'kontakt_email' => $this->faker->unique()->safeEmail,
            'twitter_username' => $this->faker->unique()->userName,
            'instagram_username' => $this->faker->unique()->userName,
            'facebook_username' => $this->faker->unique()->userName,
            'skype_username' => $this->faker->userName,
            'logotip' => $this->faker->imageUrl(640, 480, 'business'),
            'opis' => $this->faker->word(),
            'lokacija_lat' => $this->faker->latitude(),
            'lokacija_long' => $this->faker->longitude(),
            'status' => $this->faker->boolean(),
            'verifikovan' => $this->faker->boolean(),
            'privatnost' => $this->faker->boolean(),
            'kategorija_id' => Kategorija::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
