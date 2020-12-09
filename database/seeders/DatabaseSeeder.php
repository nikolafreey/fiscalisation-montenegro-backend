<?php

namespace Database\Seeders;

use App\Models\AtributRobe;
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
        TipAtributa::factory(10)->create();
        AtributRobe::factory(10)->create();
        Roba::factory(10)->create();
        CijenaRobe::factory(10)->create();
    }
}
