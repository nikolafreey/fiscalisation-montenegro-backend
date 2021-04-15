<?php

namespace Database\Seeders;

use App\Models\Paket;
use App\Models\Roba;
use App\Models\User;
use App\Models\Grupa;

use App\Models\Modul;
use App\Models\Porez;
use App\Models\Racun;
use App\Models\Usluga;
use App\Models\Partner;
use App\Models\Preduzece;
use App\Models\ZiroRacun;
use App\Scopes\UserScope;
use App\Models\CijenaRobe;
use App\Models\Djelatnost;
use App\Models\Kategorija;
use App\Models\AtributRobe;
use App\Models\DepozitWithdraw;
use App\Models\FizickoLice;
use App\Models\TipAtributa;
use App\Models\UlazniRacun;
use Illuminate\Support\Arr;
use App\Models\StavkaRacuna;
use App\Models\TipKorisnika;
use App\Models\JedinicaMjere;
use App\Models\OvlascenoLice;
use App\Models\KategorijaRobe;
use App\Models\ProizvodjacRobe;
use App\Models\RobaAtributRobe;
use Illuminate\Database\Seeder;
use App\Models\PoslovnaJedinica;
use App\Models\PodKategorijaRobe;
use App\Models\StavkaUlazniRacun;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        Kategorija::factory(10)->create();
        Preduzece::factory(20)->create();
        $users = User::factory(10)->create();



        $user = User::create([
            'email' => 'admin@admin.com',
            'ime' => 'Super',
            'prezime' => 'Admin',
            'password' => Hash::make('secret'),
        ]);

        Role::create(['name' => 'SuperAdmin']);
        Role::create(['name' => 'Default']);

        // foreach ($users as $user) {
        //     $user->assignRole('Default');
        // }

        Permission::create(['name' => 'edit preduzeca']);
        Permission::create(['name' => 'edit users']);

        $user->assignRole('SuperAdmin');

        foreach (Preduzece::all() as $preduzece) {
            PoslovnaJedinica::factory(2)->create(['preduzece_id' => $preduzece->id]);
        }

        foreach (User::all() as $user) {
            $preduzece = Preduzece::all()->random();

            DB::table('user_tip_korisnika')->insert([
                'preduzece_id' => $preduzece->id,
                'poslovna_jedinica_id' => $preduzece->poslovne_jedinice()->withoutGlobalScopes()->inRandomOrder()->first()->id,
                'user_id' => $user->id,
            ]);
        }

        DB::table('paketi')->insert([
            'id' => 0,
            'naziv' => 'Osnovni',
            'broj_uredjaja' => 1,
        ]);

        DB::table('paketi')->insert([
            'id' => 0,
            'naziv' => 'Start',
            'broj_uredjaja' => 2,
        ]);

        DB::table('paketi')->insert([
            'id' => 0,
            'naziv' => 'Pro',
            'broj_uredjaja' => 5,
        ]);

        DB::table('porezi')->insert([
            'id' => 0,
            'naziv' => 'Oslobođen PDV-a',
            'stopa' => 0
        ]);

        foreach (Preduzece::all() as $preduzece) {
            $paket = Paket::all()->random();

            DB::table('paket_preduzece')->insert([
                'preduzece_id' => $preduzece->id,
                'paket_id' => $paket->id,
            ]);
        }

        $naziviPoreza = array('0%', '7%', '21%');
        $stopePoreza = array(0, 0.07, 0.21);

        for ($i = 0; $i < 3; $i++) {
            DB::table('porezi')->insert([
                'naziv' => $naziviPoreza[$i],
                'stopa' => $stopePoreza[$i]
            ]);
        }

        FizickoLice::factory(1)->create([

            'ime' => 'Kupac',
            'prezime' => 'Kupac',
            'jmbg' => '1234567890123',
            'ib' => '2020',
            'adresa' => 'Adresa bb',
            'telefon' => '06000000',
            'telefon_viber' => true,
            'telefon_whatsapp' => true,
            'telefon_facetime' => true,
            'email' => 'kupac@gmail.com',
            'zanimanje' => 'Kupac',
            'radno_mjesto' => 'Kupac',
            'drzavljanstvo' => 'Crna Gora',
            'grad' => 'Crna Gora',
            'drzava' => 'Crna Gora',
            'status' => true,
            'nacionalnost' => 'Crna Gora',
            'cv_link' => 'cv_link',
            'avatar' => 'avatar',
            'preduzece_id' => Preduzece::all()->random()->id,

        ]);
        FizickoLice::factory(10)->create();
        ZiroRacun::factory(10)->create();
        Partner::factory(1)->create(['fizicko_lice_id' => FizickoLice::get()->first()->id]);

        foreach (Preduzece::all() as $preduzece) {

            Partner::factory(1)->create(['preduzece_id' => $preduzece->id]);
        }


        foreach (FizickoLice::all() as $fizicko_lice) {

            Partner::factory(1)->create(['fizicko_lice_id' => $fizicko_lice->id]);
        }

        // Porez::factory(1)->create();
        Grupa::factory(10)->create();

        $nazivi = ['kom', 'gr', 'kg', 'inj', 'kesa', 'pak', 'kut', 'l', 'm', 'm2', 'm3', 'par', 'tab', 't', 'vre', 'pal', 'sek', 'min', 'sat', 'dan'];

        $naziviDugi = ['komad', 'gram', 'kilogram', 'injekcija', 'kesa', 'paket', 'kutija', 'litar', 'metar', 'm2', 'm3', 'par', 'tableta', 'tona', 'vreća', 'paleta', 'sekund', 'minut', 'sat', 'dan'];

        for ($i = 0; $i < count($nazivi); $i++) {
            DB::table('jedinice_mjere')->insert(
                [
                    'naziv' => $nazivi[$i],
                    'kratki_naziv' => $naziviDugi[$i],
                    'deleted_at' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        Usluga::factory(10)->create();
        KategorijaRobe::factory(10)->create();
        PodKategorijaRobe::factory(10)->create();
        ProizvodjacRobe::factory(10)->create();
        Roba::factory(10)->create();
        TipAtributa::factory(10)->create();
        AtributRobe::factory(10)->create();
        //CijenaRobe::factory(10)->create();
        UlazniRacun::factory(10)->create();

        foreach (PoslovnaJedinica::all() as $poslovnaJedinica) {
            DepozitWithdraw::factory(1)->create([
                'iznos_depozit' => rand(50, 100),
                'iznos_withdraw' => null,
                'poslovna_jedinica_id' => $poslovnaJedinica->id,
                'preduzece_id' => $poslovnaJedinica->preduzece->id
            ]);

            Racun::factory(2)->create([
                'poslovna_jedinica_id' => $poslovnaJedinica->id,
                'preduzece_id' => Preduzece::all()->random()->id,
            ]);
        }

        foreach (Racun::all() as $racun) {
            StavkaRacuna::factory(2)->create(['racun_id' => $racun->id]);
        }

        StavkaUlazniRacun::factory(10)->create();


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

            // DB::table('robe_cijene_roba')->insert(
            //     [
            //         'roba_id' => Roba::all()->random()->id,
            //         'cijena_robe_id' => CijenaRobe::all()->random()->id,
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ]
            // );

            // DB::table('kategorije_roba')->insert(
            //     [
            //         'roba_id' => Roba::all()->random()->id,
            //         'kategorije_id' => KategorijaRobe::all()->random()->id,
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ]
            // );

            DB::table('robe_atributi_roba')->insert(
                [
                    'roba_id' => Roba::withoutGlobalScope(UserScope::class)->get()->random()->id,
                    'atribut_id' => AtributRobe::withoutGlobalScope(UserScope::class)->get()->random()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            DB::table('porezi_za_racun')->insert(
                [
                    'racun_id' => Racun::withoutGlobalScope(UserScope::class)->get()->random()->id,
                    'porez_id' => Porez::all()->random()->id,
                    'pdv_iznos_ukupno' => Racun::withoutGlobalScope(UserScope::class)->get()->random()->ukupan_iznos_pdv
                ]
            );
        }

        $cijeneAtributaRoba = [];
        foreach (RobaAtributRobe::all() as $robaAtributRobe) {
            $cijeneAtributaRoba[] = CijenaRobe::factory()->make([
                'roba_id' => $robaAtributRobe->roba_id,
                'atribut_id' => $robaAtributRobe->atribut_id,
                'preduzece_id' => Preduzece::all()->random()->id,
                'porez_id' => Porez::all()->random()->id,
                'user_id' => User::all()->random()->id
            ])->toArray();
        };
        DB::table('cijene_roba')->insert($cijeneAtributaRoba);
    }
}
