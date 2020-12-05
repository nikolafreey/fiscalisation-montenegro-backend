<?php

namespace Database\Factories;

use App\Models\JedinicaMjere;
use Illuminate\Database\Eloquent\Factories\Factory;

class JedinicaMjereFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JedinicaMjere::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'naziv' => $this->faker->word(),
            'kratki_naziv' => $this->faker->word(),
       
        ];
    }
}
