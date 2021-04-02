<?php

namespace Database\Factories;

use App\Models\CijenaRobe;
use App\Models\Porez;
use App\Models\User;
use App\Models\Roba;
use App\Models\AtributRobe;
use App\Scopes\UserScope;
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
        $user = User::all()->random();
        $porez = Porez::all()->random();
        $cijena_bez_pdv =  $this->faker->randomFloat(2, 0, 100);
        $ukupna_cijena = $cijena_bez_pdv * $porez->stopa + $cijena_bez_pdv;
        return [
            'nabavna_cijena_bez_pdv' => $this->faker->randomFloat(2, 0, 100),
            'nabavna_cijena_sa_pdv' => $this->faker->randomFloat(2, 0, 100),
            'cijena_bez_pdv_popust' => $this->faker->randomFloat(2, 0, 100),
            'cijena_sa_pdv_popust' => $this->faker->randomFloat(2, 0, 100),
            'iznos_pdv_popust' => $this->faker->randomFloat(2, 0, 100),
            'cijena_bez_pdv' => $cijena_bez_pdv,
            'ukupna_cijena' => $ukupna_cijena,
            'user_id' => $user->id,
            'preduzece_id' => $user->preduzeca()->first(),
            'porez_id' => $porez->id,
            'roba_id' => Roba::withoutGlobalScope(UserScope::class)->get()->random()->id,
            'atribut_id' => AtributRobe::withoutGlobalScope(UserScope::class)->get()->random()->id

        ];
    }
}
