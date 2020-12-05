<?php

namespace Database\Factories;

use App\Models\Modul;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModulFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Modul::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'naziv' => $this->faker->unique()->word()
        ];
    }
}
