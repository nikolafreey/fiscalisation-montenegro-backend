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
        // $nazivi = array('kom', 'gr', 'kg', 'inj', 'kesa', 'pak', 'kut', 'l', 'm', 'm2', 'm3', 'par', 'tab', 't', 'vre', 'pal', 'sek', 'min', 'sat', 'dan');
        // $naziviDugi = array('komad', 'gram', 'kilogram', 'injekcija', 'kesa', 'paket', 'kutija', 'litar', 'metar', 'm2', 'm3', 'par', 'tableta', 'tona', 'vreća', 'paleta', 'sekund', 'minut', 'sat', 'dan');

        // for ($i = 0; $i < count($nazivi); $i++) {
        //     DB::table('jedinice_mjere')->insert(
        //         [
        //             'naziv' => $nazivi[$i],
        //             'kratki_naziv' => $naziviDugi[$i],
        //             'deleted_at' => null,
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]
        //     );
        // }
    }
}
