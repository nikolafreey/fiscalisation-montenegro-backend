<?php

namespace Database\Factories;

use App\Models\Modul;
use App\Models\ModulUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModulUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ModulUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'modul_id' => Modul::all()->random()->id,
        ];
    }
}
