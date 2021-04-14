<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Porez;

class PorezSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nazivi = array('Oslobođen', '0%', '7%', '21%');
        $stope = array(0, 0, 7, 21);

        for($i = 0; $i < count($nazivi); $i++){
            Porez::insert([
                'naziv' => $nazivi[$i],
                'stopa' => $stope[$i]
            ]);
        }
    }
}
