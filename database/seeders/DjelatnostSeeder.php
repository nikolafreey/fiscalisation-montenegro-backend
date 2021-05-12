<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DjelatnostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nazivi = array(
            'Poljoprivreda, šumarstvo i ribarstvo', 'Vađenje rude i kamena', 'Prerađivačka industrija', 'Snabdjevanje električnom energijom', 'Snabdjevanje vodom', 'Građevinarstvo', 'Trgovina na veliko i trgovina na malo', 'Popravka motornih vozila i motocikala', 'Saobraćaj i skladištenje',
            'Usluge smještaja i ishrane', 'Informisanje i komunikacije', 'Finansijske djelatnosti i djelatnosti osiguranja', 'Poslovanje nekretninama', 'Stručne, naučne i tehničke djelatnosti',
            'Administrativne i pomoćne uslužne djelatnosti', 'Obrazovanje', 'Zdravstvo i socijalna zaštita', 'Umjetničke, zabavne i rekreativne djelatnosti', 'Zanatstvo', 'Ostalo'
        );

        for ($i = 0; $i < count($nazivi); $i++) {
            \DB::table('djelatnosti')->insert(
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
