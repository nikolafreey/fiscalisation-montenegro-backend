<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRolesAndPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:sync';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting to sync roles');

        Role::firstOrCreate(['name' => 'superadmin']);
        Role::firstOrCreate(['name' => 'vlasnik']);
        Role::firstOrCreate(['name' => 'zaposleni']);
        Role::firstOrCreate(['name' => 'knjigovodja']);
        Role::firstOrCreate(['name' => 'kasir']);
        Role::firstOrCreate(['name' => 'gost']);

        Permission::firstOrCreate(['name' => 'edit preduzeca']);
        Permission::firstOrCreate(['name' => 'edit users']);


        Permission::firstOrCreate(['name' => 'view AtributRobe']);
        Permission::firstOrCreate(['name' => 'show AtributRobe']);
        Permission::firstOrCreate(['name' => 'create AtributRobe']);
        Permission::firstOrCreate(['name' => 'update AtributRobe']);
        Permission::firstOrCreate(['name' => 'delete AtributRobe']);


        Permission::firstOrCreate(['name' => 'view CijenaRobe']);
        Permission::firstOrCreate(['name' => 'show CijenaRobe']);
        Permission::firstOrCreate(['name' => 'create CijenaRobe']);
        Permission::firstOrCreate(['name' => 'update CijenaRobe']);
        Permission::firstOrCreate(['name' => 'delete CijenaRobe']);


        Permission::firstOrCreate(['name' => 'view DepozitWithdraw']);
        Permission::firstOrCreate(['name' => 'show DepozitWithdraw']);
        Permission::firstOrCreate(['name' => 'create DepozitWithdraw']);
        Permission::firstOrCreate(['name' => 'update DepozitWithdraw']);
        Permission::firstOrCreate(['name' => 'delete DepozitWithdraw']);


        Permission::firstOrCreate(['name' => 'view Djelatnost']);
        Permission::firstOrCreate(['name' => 'show Djelatnost']);
        Permission::firstOrCreate(['name' => 'create Djelatnost']);
        Permission::firstOrCreate(['name' => 'update Djelatnost']);
        Permission::firstOrCreate(['name' => 'delete Djelatnost']);


        Permission::firstOrCreate(['name' => 'view FizickoLice']);
        Permission::firstOrCreate(['name' => 'show FizickoLice']);
        Permission::firstOrCreate(['name' => 'create FizickoLice']);
        Permission::firstOrCreate(['name' => 'update FizickoLice']);
        Permission::firstOrCreate(['name' => 'delete FizickoLice']);


        Permission::firstOrCreate(['name' => 'view Grupa']);
        Permission::firstOrCreate(['name' => 'show Grupa']);
        Permission::firstOrCreate(['name' => 'create Grupa']);
        Permission::firstOrCreate(['name' => 'update Grupa']);
        Permission::firstOrCreate(['name' => 'delete Grupa']);


        Permission::firstOrCreate(['name' => 'view JedinicaMjere']);
        Permission::firstOrCreate(['name' => 'show JedinicaMjere']);
        Permission::firstOrCreate(['name' => 'create JedinicaMjere']);
        Permission::firstOrCreate(['name' => 'update JedinicaMjere']);
        Permission::firstOrCreate(['name' => 'delete JedinicaMjere']);


        Permission::firstOrCreate(['name' => 'view Kategorija']);
        Permission::firstOrCreate(['name' => 'show Kategorija']);
        Permission::firstOrCreate(['name' => 'create Kategorija']);
        Permission::firstOrCreate(['name' => 'update Kategorija']);
        Permission::firstOrCreate(['name' => 'delete Kategorija']);


        Permission::firstOrCreate(['name' => 'view KategorijaRobe']);
        Permission::firstOrCreate(['name' => 'show KategorijaRobe']);
        Permission::firstOrCreate(['name' => 'create KategorijaRobe']);
        Permission::firstOrCreate(['name' => 'update KategorijaRobe']);
        Permission::firstOrCreate(['name' => 'delete KategorijaRobe']);


        Permission::firstOrCreate(['name' => 'view Modul']);
        Permission::firstOrCreate(['name' => 'show Modul']);
        Permission::firstOrCreate(['name' => 'create Modul']);
        Permission::firstOrCreate(['name' => 'update Modul']);
        Permission::firstOrCreate(['name' => 'delete Modul']);


        Permission::firstOrCreate(['name' => 'view OvlascenoLice']);
        Permission::firstOrCreate(['name' => 'show OvlascenoLice']);
        Permission::firstOrCreate(['name' => 'create OvlascenoLice']);
        Permission::firstOrCreate(['name' => 'update OvlascenoLice']);
        Permission::firstOrCreate(['name' => 'delete OvlascenoLice']);


        Permission::firstOrCreate(['name' => 'view Partner']);
        Permission::firstOrCreate(['name' => 'show Partner']);
        Permission::firstOrCreate(['name' => 'create Partner']);
        Permission::firstOrCreate(['name' => 'update Partner']);
        Permission::firstOrCreate(['name' => 'delete Partner']);


        Permission::firstOrCreate(['name' => 'view PodKategorijaRobe']);
        Permission::firstOrCreate(['name' => 'show PodKategorijaRobe']);
        Permission::firstOrCreate(['name' => 'create PodKategorijaRobe']);
        Permission::firstOrCreate(['name' => 'update PodKategorijaRobe']);
        Permission::firstOrCreate(['name' => 'delete PodKategorijaRobe']);


        Permission::firstOrCreate(['name' => 'view Porez']);
        Permission::firstOrCreate(['name' => 'show Porez']);
        Permission::firstOrCreate(['name' => 'create Porez']);
        Permission::firstOrCreate(['name' => 'update Porez']);
        Permission::firstOrCreate(['name' => 'delete Porez']);


        Permission::firstOrCreate(['name' => 'view PoslovnaJedinica']);
        Permission::firstOrCreate(['name' => 'show PoslovnaJedinica']);
        Permission::firstOrCreate(['name' => 'create PoslovnaJedinica']);
        Permission::firstOrCreate(['name' => 'update PoslovnaJedinica']);
        Permission::firstOrCreate(['name' => 'delete PoslovnaJedinica']);


        Permission::firstOrCreate(['name' => 'view Predracun']);
        Permission::firstOrCreate(['name' => 'show Predracun']);
        Permission::firstOrCreate(['name' => 'create Predracun']);
        Permission::firstOrCreate(['name' => 'update Predracun']);
        Permission::firstOrCreate(['name' => 'delete Predracun']);


        Permission::firstOrCreate(['name' => 'view Preduzece']);
        Permission::firstOrCreate(['name' => 'show Preduzece']);
        Permission::firstOrCreate(['name' => 'create Preduzece']);
        Permission::firstOrCreate(['name' => 'update Preduzece']);
        Permission::firstOrCreate(['name' => 'delete Preduzece']);


        Permission::firstOrCreate(['name' => 'view ProizvodjaciRobe']);
        Permission::firstOrCreate(['name' => 'show ProizvodjaciRobe']);
        Permission::firstOrCreate(['name' => 'create ProizvodjaciRobe']);
        Permission::firstOrCreate(['name' => 'update ProizvodjaciRobe']);
        Permission::firstOrCreate(['name' => 'delete ProizvodjaciRobe']);


        Permission::firstOrCreate(['name' => 'view Racun']);
        Permission::firstOrCreate(['name' => 'show Racun']);
        Permission::firstOrCreate(['name' => 'create Racun']);
        Permission::firstOrCreate(['name' => 'update Racun']);
        Permission::firstOrCreate(['name' => 'delete Racun']);


        Permission::firstOrCreate(['name' => 'view Roba']);
        Permission::firstOrCreate(['name' => 'show Roba']);
        Permission::firstOrCreate(['name' => 'create Roba']);
        Permission::firstOrCreate(['name' => 'update Roba']);
        Permission::firstOrCreate(['name' => 'delete Roba']);


        Permission::firstOrCreate(['name' => 'view TipKorisnika']);
        Permission::firstOrCreate(['name' => 'show TipKorisnika']);
        Permission::firstOrCreate(['name' => 'create TipKorisnika']);
        Permission::firstOrCreate(['name' => 'update TipKorisnika']);
        Permission::firstOrCreate(['name' => 'delete TipKorisnika']);


        Permission::firstOrCreate(['name' => 'view TipAtributa']);
        Permission::firstOrCreate(['name' => 'show TipAtributa']);
        Permission::firstOrCreate(['name' => 'create TipAtributa']);
        Permission::firstOrCreate(['name' => 'update TipAtributa']);
        Permission::firstOrCreate(['name' => 'delete TipAtributa']);


        Permission::firstOrCreate(['name' => 'view UlazniRacun']);
        Permission::firstOrCreate(['name' => 'show UlazniRacun']);
        Permission::firstOrCreate(['name' => 'create UlazniRacun']);
        Permission::firstOrCreate(['name' => 'update UlazniRacun']);
        Permission::firstOrCreate(['name' => 'delete UlazniRacun']);


        Permission::firstOrCreate(['name' => 'view User']);
        Permission::firstOrCreate(['name' => 'show User']);
        Permission::firstOrCreate(['name' => 'create User']);
        Permission::firstOrCreate(['name' => 'update User']);
        Permission::firstOrCreate(['name' => 'delete User']);


        Permission::firstOrCreate(['name' => 'view Usluga']);
        Permission::firstOrCreate(['name' => 'show Usluga']);
        Permission::firstOrCreate(['name' => 'create Usluga']);
        Permission::firstOrCreate(['name' => 'update Usluga']);
        Permission::firstOrCreate(['name' => 'delete Usluga']);


        Permission::firstOrCreate(['name' => 'view ZiroRacun']);
        Permission::firstOrCreate(['name' => 'show ZiroRacun']);
        Permission::firstOrCreate(['name' => 'create ZiroRacun']);
        Permission::firstOrCreate(['name' => 'update ZiroRacun']);
        Permission::firstOrCreate(['name' => 'delete ZiroRacun']);


        User::where('ime', 'Super Admin')->firstOrFail()->syncRoles(['superadmin']);

        $this->info('Done');

        return 0;
    }
}
