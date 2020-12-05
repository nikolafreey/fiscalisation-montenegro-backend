<?php

namespace Database\Factories;

use App\Models\Grupa;
use App\Models\JedinicaMjere;
use App\Models\Porez;
use App\Models\User;
use App\Models\Usluga;
use Illuminate\Database\Eloquent\Factories\Factory;

class UslugaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usluga::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'naziv' => $this->faker->word(),
            'opis' => $this->faker->text(),
            'cijena_bez_pdv' => $this->faker->randomFloat(),
            'pdv_iznos' => $this->faker->randomFloat(),
            'ukupna_cijena' => $this->faker->randomFloat(),
            'status' => $this->faker->boolean(),
            'user_id' => User::all()->random()->id,
            'grupa_id' => Grupa::all()->random()->id,
            'jedinica_mjere_id' => JedinicaMjere::all()->random()->id,
            'porez_id' => Porez::all()->random()->id,
        ];
    }
}
