<?php

namespace Database\Factories;

use App\Models\KategorijaRobe;
use App\Models\PodKategorijaRobe;
use App\Models\User;
use App\Scopes\UserScope;
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
        $user = User::all()->random();

        return [
            'naziv' => $this->faker->word,
            'opis' => $this->faker->text,
            'popust_procenti' => $this->faker->randomFloat(),
            'popust_iznos' => $this->faker->randomFloat(),
            'status' => $this->faker->boolean(),
            'user_id' => $user->id,
            'preduzece_id' => $user->preduzeca()->first(),
            'kategorija_id' => KategorijaRobe::withoutGlobalScope(UserScope::class)->get()->random()->id
        ];
    }
}
