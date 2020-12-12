<?php

namespace Database\Factories;

use App\Models\Djelatnost;
use Illuminate\Database\Eloquent\Factories\Factory;

class DjelatnostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Djelatnost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'naziv' => $this->faker->unique()->word(),
            
        ];
    }
}
