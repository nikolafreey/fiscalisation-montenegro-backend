<?php

namespace Database\Factories;

use App\Models\JedinicaMjere;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

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
        $nazivi = array('kom', 'gr', 'inj', 'kesa', 'pak', 'kg', 'kut', 'lit', 'm', 'm2', 'm3', 'par', 'tab', 't', 'vre', 'pal');
        $naziviDugi = array('komad', 'gram', 'injekcija', 'kesa', 'paket', 'kilogram', 'kutija', 'litar', 'metar', 'm2', 'm3', 'par', 'tableta', 'tona', 'vreća', 'paleta');

        for ($i = 0; $i < count($nazivi); $i++) {
            DB::table('jedinice_mjere')->insert(
                [
                    'naziv' => $naziviDugi[$i],
                    'kratki_naziv' => $nazivi[$i],
                    'deleted_at' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
