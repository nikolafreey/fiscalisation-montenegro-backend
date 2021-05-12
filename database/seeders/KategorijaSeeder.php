<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KategorijaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nazivi = array(
            'Ostalo'
        );

        for ($i = 0; $i < count($nazivi); $i++) {
            \DB::table('kategorije')->insert(
                [
                    'naziv' => $nazivi[$i],
                    'deleted_at' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
