<?php

namespace Database\Factories;

use App\Models\Djelatnost;
use Illuminate\Database\Eloquent\Factories\Factory;

class DjelatnostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Djelatnost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $djelatnosti = array(
            'Poljoprivreda, šumarstvo i ribarstvo', 'Vađenje rude i kamena', 'Prerađivačka industrija', 'Snabdjevanje električnom energijom', 'Snabdjevanje vodom', 'Građevinarstvo', 'Trgovina na veliko i trgovina na malo', 'Popravka motornih vozila i motocikala', 'Saobraćaj i skladištenje',
            'Usluge smještaja i ishrane', 'Informisanje i komunikacije', 'Finansijske djelatnosti i djelatnosti osiguranja', 'Poslovanje nekretninama', 'Stručne, naučne i tehničke djelatnosti',
            'Administrativne i pomoćne uslužne djelatnosti', 'Obrazovanje', 'Zdravstvo i socijalna zaštita', 'Umjetničke, zabavne i rekreativne djelatnosti', 'Zanatstvo', 'Ostalo'
        );

        return [
            'naziv' => $this->faker->randomElement($djelatnosti),

        ];
    }
}
