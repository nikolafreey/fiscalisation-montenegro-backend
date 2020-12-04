<?php

namespace Database\Factories;

use App\Models\OvlascenoLice;
use Illuminate\Database\Eloquent\Factories\Factory;

class OvlascenoLiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OvlascenoLice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ime' => $this->faker->firstName(), 
            'prezime' => $this->faker->lastName(), 
            'telefon' => $this->faker->phoneNumber, 
            'telefon_viber' => $this->faker->boolean(), 
            'telefon_whatsapp' => $this->faker->boolean(), 
            'telefon_facetime' => $this->faker->boolean(), 
            'email' => $this->faker->safeEmail()
        ];
    }
}
