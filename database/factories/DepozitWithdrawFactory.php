<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\DepozitWithdraw;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepozitWithdrawFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DepozitWithdraw::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
        ];
    }
}
