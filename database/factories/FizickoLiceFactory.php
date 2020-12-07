<?php

namespace Database\Factories;

use App\Models\FizickoLice;
use App\Models\Preduzece;
use Illuminate\Database\Eloquent\Factories\Factory;

class FizickoLiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FizickoLice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ime' => $this->faker->firstname(),
            'prezime' => $this->faker->lastname(),
            'jmbg' => $this->faker->unique()->year(),
            'ib' => $this->faker->year(),
            'adresa' => $this->faker->streetName(),
            'telefon' => $this->faker->phoneNumber(),
            'telefon_viber' => $this->faker->boolean(),
            'telefon_whatsapp' => $this->faker->boolean(),
            'telefon_facetime' => $this->faker->boolean(),
            'email' => $this->faker->unique()->safeEmail,
            'zanimanje' => $this->faker->randomFloat(),
            'radno_mjesto' => $this->faker->randomFloat(),
            'drzavljanstvo' => $this->faker->country(),
            'grad' => $this->faker->country(),
            'drzava' => $this->faker->country(),
            'status' => $this->faker->boolean(),

            'nacionalnost' => $this->faker->country(),
            'cv_link' => $this->faker->mimeType(),
            'avatar' => $this->faker->imageUrl(640, 480, 'people'),

            'preduzece_id' => Preduzece::all()->random()->id,
        ];
    }
}
