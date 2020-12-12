<?php

namespace Database\Factories;

use App\Models\CijenaRobe;
use App\Models\Porez;
use App\Models\User;
use App\Models\Roba;
use App\Models\AtributRobe;

use Illuminate\Database\Eloquent\Factories\Factory;

class CijenaRobeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CijenaRobe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nabavna_cijena_bez_pdv' => $this->faker->randomFloat(),
            'nabavna_cijena_sa_pdv' => $this->faker->randomFloat(),
            'cijena_bez_pdv' => $this->faker->randomFloat(),
            'ukupna_cijena' => $this->faker->randomFloat(),
            'user_id' => User::all()->random()->id,
            'porez_id' => Porez::all()->random()->id,
            'roba_id' => Roba::all()->random()->id,
            'atribut_id' => AtributRobe::all()->random()->id

        ];
    }
}
