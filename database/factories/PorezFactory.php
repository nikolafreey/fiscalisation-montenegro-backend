<?php

namespace Database\Factories;

use App\Models\Porez;
use Illuminate\Database\Eloquent\Factories\Factory;

class PorezFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Porez::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stopa' => $this->faker->randomFloat(2, 0, 10),
            'naziv' => $this->faker->unique()->word()
        ];
    }
}
