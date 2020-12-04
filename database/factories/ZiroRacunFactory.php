<?php

namespace Database\Factories;

use App\Models\FizickoLice;
use App\Models\Preduzece;
use App\Models\ZiroRacun;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZiroRacunFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ZiroRacun::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'broj_racuna' => $this->faker->unique()->word(),
            'preduzece_id' => Preduzece::all()->random()->id,
            'fizicko_lice_id' => FizickoLice::all()->random()->id
        ];
    }
}
