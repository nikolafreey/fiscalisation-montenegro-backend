<?php

namespace Database\Factories;

use App\Models\JedinicaMjere;
use App\Models\Porez;
use App\Models\Racun;
use App\Models\StavkaRacuna;
use App\Models\User;
use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\Factory;

class StavkaRacunaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StavkaRacuna::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'naziv' => $this->faker->words(3, true),
            'opis' => $this->faker->text(),
            'jedinicna_cijena_bez_pdv' => $this->faker->randomFloat(2, 0, 100),
            'kolicina' => $this->faker->randomFloat(2, 0, 100),
            'pdv_iznos' => $this->faker->randomFloat(2, 0, 100),
            'popust_procenat' => $this->faker->randomFloat(2, 0, 100),
            'popust_iznos' => $this->faker->randomFloat(2, 0, 100),
            'popust_na_jedinicnu_cijenu' => $this->faker->randomFloat(2, 0, 100),
            'cijena_sa_pdv' => $this->faker->randomFloat(2, 0, 100),
            'porez_id' => Porez::all()->random()->id,
            'jedinica_id' => JedinicaMjere::all()->random()->id,
            'racun_id' => Racun::withoutGlobalScope(UserScope::class)->get()->random()->id,
        ];
    }
}
