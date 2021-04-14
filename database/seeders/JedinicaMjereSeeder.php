<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JedinicaMjereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nazivi = array('kom', 'gr', 'kg', 'inj', 'kesa', 'pak', 'kut', 'l', 'm', 'm2', 'm3', 'par', 'tab', 't', 'vre', 'pal', 'sek', 'min', 'sat', 'dan');
        $naziviDugi = array('komad', 'gram', 'kilogram', 'injekcija', 'kesa', 'paket', 'kutija', 'litar', 'metar', 'm2', 'm3', 'par', 'tableta', 'tona', 'vreća', 'paleta', 'sekund', 'minut', 'sat', 'dan');

        for ($i = 0; $i < count($nazivi); $i++) {
            \DB::table('jedinice_mjere')->insert(
                [
                    'naziv' => $nazivi[$i],
                    'kratki_naziv' => $naziviDugi[$i],
                    'deleted_at' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
