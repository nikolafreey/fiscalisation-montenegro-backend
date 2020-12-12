<?php

namespace Database\Factories;

use App\Models\JedinicaMjere;
use App\Models\Preduzece;
use App\Models\ProizvodjacRobe;
use App\Models\Roba;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RobaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Roba::class;

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
            'opis' => $this->faker->text(),
            'detaljni_opis' => $this->faker->text(),
            'ean' => $this->faker->word(),
            'interna_sifra_proizvoda' => $this->faker->word(),
            'status' => $this->faker->boolean(),
            'proizvodjac_robe_id' => ProizvodjacRobe::all()->random()->id,
            'jedinica_mjere_id' => JedinicaMjere::all()->random()->id,
            'user_id' => $user->id,
            'preduzece_id' => $user->preduzeca()->first()
        ];
    }
}
