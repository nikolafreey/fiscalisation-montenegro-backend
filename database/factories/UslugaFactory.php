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
        $user = User::all()->random();
        $porez = Porez::all()->random();
        $cijena_bez_pdv =  $this->faker->randomFloat(2, 0, 100);
        $ukupna_cijena = $cijena_bez_pdv * $porez->stopa + $cijena_bez_pdv;
        return [
            'naziv' => $this->faker->word(),
            'opis' => $this->faker->text(),
            'cijena_bez_pdv' => $cijena_bez_pdv,
            'ukupna_cijena' => $ukupna_cijena,
            'status' => $this->faker->boolean(),
            'user_id' => $user->id,
            'preduzece_id' => $user->preduzeca()->first(),
            'grupa_id' => Grupa::all()->random()->id,
            'jedinica_mjere_id' => JedinicaMjere::all()->random()->id,
            'porez_id' => $porez->id,
        ];
    }
}
