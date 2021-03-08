<?php

namespace Database\Factories;

use App\Models\JedinicaMjere;
use Illuminate\Database\Eloquent\Factories\Factory;

class JedinicaMjereFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JedinicaMjere::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nazivi = array('gr', 'inj', 'kesa', 'kes', 'kg', 'kom', 'komad', 'kut', 'lit', 'm2', 'M', 'M2', 'M3', 'pak', 'par', 'tab', 't', 'vre');
        $naziviDugi = array('gram', 'inj', 'kesa', 'kes', 'kilogram', 'komad', 'kutija', 'litar', 'm2', 'metar', 'M2', 'M3', 'pak', 'par', 'tab', 'tona', 'vre');

        return [
            'naziv' => $this->faker->unique()->randomElement($naziviDugi),
            'kratki_naziv' => $this->faker->unique()->randomElement($nazivi),

        ];
    }
}
