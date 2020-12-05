<?php

namespace Database\Factories;

use App\Models\KategorijaRobe;
use App\Models\PodKategorijaRobe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PodKategorijaRobeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PodKategorijaRobe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'naziv' => $this->faker->word,
            'opis' => $this->faker->text, 
            'popust_procenti' => $this->faker->randomFloat(), 
            'popust_iznos' => $this->faker->randomFloat(), 
            'status' => $this->faker->boolean(), 
            'user_id' => User::all()->random()->id,
            'kategorija_id' => KategorijaRobe::all()->random()->id
        ];
    }
}
