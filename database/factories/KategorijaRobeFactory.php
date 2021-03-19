<?php

namespace Database\Factories;

use App\Models\KategorijaRobe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class KategorijaRobeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = KategorijaRobe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->random();

        return [
            'naziv' => $this->faker->word,
            'opis' => $this->faker->text,
            'popust_procenti' => $this->faker->randomFloat(2,0,10),
            'popust_iznos' => $this->faker->randomFloat(2,0,10),
            'status' => $this->faker->boolean(),
            'user_id' => $user->id,
            'preduzece_id' => $user->preduzeca()->first()
        ];
    }
}
