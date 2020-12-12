<?php

namespace Database\Factories;

use App\Models\AtributRobe;
use App\Models\TipAtributa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AtributRobeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AtributRobe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->random();

        return [
            'naziv' => $this->faker->word(),
            'opis' => $this->faker->name(),
            'popust_procenti' => $this->faker->randomFloat(),
            'popust_iznos' => $this->faker->randomFloat(),
            'user_id' => $user->id,
            'preduzece_id' => $user->preduzeca()->first(),
            'tip_atributa_id' => TipAtributa::all()->random()->id
        ];
    }
}
