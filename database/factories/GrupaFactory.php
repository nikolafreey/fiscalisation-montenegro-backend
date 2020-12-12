<?php

namespace Database\Factories;

use App\Models\Grupa;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrupaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grupa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'naziv' => $this->faker->unique()->word(),
            'opis' => $this->faker->name(),
            'popust_procenti' => $this->faker->randomFloat(2,0,10),
            'popust_iznos' => $this->faker->randomFloat(2,0,10),
           
        ];
    }
}
