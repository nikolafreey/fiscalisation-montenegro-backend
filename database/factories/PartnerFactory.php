<?php

namespace Database\Factories;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Partner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kontakt_ime' => $this->faker->firstName(), 
            'kontakt_prezime' => $this->faker->lastName(), 
            'kontakt_telefon' => $this->faker->phoneNumber, 
            'kontakt_viber' => $this->faker->boolean(), 
            'kontakt_whatsapp' => $this->faker->boolean(), 
            'kontakt_facetime' => $this->faker->boolean(), 
            'opis' => $this->faker->text(),
            'user_id' => User::all()->random()->id
        ];
    }
}
