<?php

namespace Database\Seeders;

use App\Models\AtributRobe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use App\Models\CijenaRobe;
use App\Models\Djelatnost;
use App\Models\FizickoLice;
use App\Models\Grupa;
use App\Models\JedinicaMjere;
use App\Models\Kategorija;
use App\Models\KategorijaRobe;
use App\Models\Modul;
use App\Models\OvlascenoLice;
use App\Models\Partner;
use App\Models\PodKategorijaRobe;
use App\Models\Porez;
use App\Models\Preduzece;
use App\Models\ProizvodjacRobe;
use App\Models\Roba;
use App\Models\TipAtributa;
use App\Models\TipKorisnika;
use App\Models\User;
use App\Models\Usluga;
use App\Models\ZiroRacun;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Djelatnost::factory(10)->create();
        Modul::factory(10)->create();
        OvlascenoLice::factory(10)->create();
        TipKorisnika::factory(10)->create();
        Kategorija::factory(10)->create();
        Preduzece::factory(100)->create();
        User::factory(10)->create();
        User::factory(1)->create(['email' => 'test@gmail.com']);
        FizickoLice::factory(10)->create();
        ZiroRacun::factory(10)->create();
        Partner::factory(5)->create(['preduzece_id' => Preduzece::all()->random()->id]);
        Partner::factory(5)->create(['fizicko_lice_id' => FizickoLice::all()->random()->id]);
        Porez::factory(10)->create();
        Grupa::factory(10)->create();
        JedinicaMjere::factory(10)->create();
        Usluga::factory(10)->create();
        KategorijaRobe::factory(10)->create();
        PodKategorijaRobe::factory(10)->create();
        ProizvodjacRobe::factory(10)->create();
        Roba::factory(10)->create();
        TipAtributa::factory(10)->create();
        AtributRobe::factory(10)->create();
        CijenaRobe::factory(10)->create();
        AtributRobe::factory(10)->create();

        $djelatnostiIds = DB::table('djelatnosti')->pluck('id')->toArray();
        $preduzecaIds = DB::table('preduzeca')->pluck('id')->toArray();
        $usersIds = DB::table('users')->pluck('id')->toArray();
        $ovlascena_licaIds = DB::table('ovlascena_lica')->pluck('id')->toArray();
        $robeIds = DB::table('robe')->pluck('id')->toArray();
        $kategorijeIds = DB::table('kategorije')->pluck('id')->toArray();

        // DB::table('ovlasceno_lice_preduzece')->insert(
        //     [
        //         'ovlasceno_lice_id' => 1,
        //         'preduzece_id' => 1
        //     ]
        // );

        foreach ((range(1, 10)) as $index) {
            DB::table('ovlasceno_lice_preduzece')->insert(
                [
                    'ovlasceno_lice_id' => OvlascenoLice::all()->random()->id,
                    'preduzece_id' => Preduzece::all()->random()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            DB::table('preduzece_djelatnost')->insert(
                [
                    'djelatnost_id' => Djelatnost::all()->random()->id,
                    'preduzece_id' => Preduzece::all()->random()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            DB::table('robe_cijene_roba')->insert(
                [
                    'roba_id' => Roba::all()->random()->id,
                    'cijena_robe_id' => CijenaRobe::all()->random()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            DB::table('robe_kategorije')->insert(
                [
                    'roba_id' => Roba::all()->random()->id,
                    'kategorije_id' => KategorijaRobe::all()->random()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            DB::table('robe_atributi_roba')->insert(
                [
                    'robe_id' => Roba::all()->random()->id,
                    'atributi_roba_id' => AtributRobe::all()->random()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
