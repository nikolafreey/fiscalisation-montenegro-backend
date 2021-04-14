<?php

namespace Database\Factories;

use App\Models\Porez;
use Illuminate\Database\Eloquent\Factories\Factory;

class PorezFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Porez::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $nazivi = array('0%', '7%', '21%');
        // $stope = array(0, 7, 21);

        // return [
        //     'stopa' => $this->faker->randomElement(),
        //     'naziv' => $this->faker->randomElement($nazivi)
        // ];
    }
}
