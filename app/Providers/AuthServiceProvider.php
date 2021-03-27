<?php

namespace App\Providers;

use App\Models\AtributRobe;
use App\Models\CijenaRobe;
use App\Models\DepozitWithdraw;
use App\Models\Djelatnost;
use App\Models\Dokument;
use App\Models\FizickoLice;
use App\Models\Grupa;
use App\Models\JedinicaMjere;
use App\Models\Kategorija;
use App\Models\KategorijaDokumenta;
use App\Models\KategorijaRobe;
use App\Models\Modul;
use App\Models\OvlascenoLice;
use App\Models\Partner;
use App\Models\PodKategorijaRobe;
use App\Models\Porez;
use App\Models\PoslovnaJedinica;
use App\Models\Preduzece;
use App\Models\ProizvodjacRobe;
use App\Models\Racun;
use App\Models\Roba;
use App\Models\TipAtributa;
use App\Models\TipKorisnika;
use App\Models\UlazniRacun;
use App\Models\User;
use App\Models\Usluga;
use App\Models\ZiroRacun;
use App\Policies\AtributRobePolicy;
use App\Policies\CijenaRobePolicy;
use App\Policies\DepozitWithdrawPolicy;
use App\Policies\DjelatnostPolicy;
use App\Policies\DokumentPolicy;
use App\Policies\FizickoLicePolicy;
use App\Policies\GrupaPolicy;
use App\Policies\JedinicaMjerePolicy;
use App\Policies\KategorijaDokumentaPolicy;
use App\Policies\KategorijaPolicy;
use App\Policies\KategorijaRobePolicy;
use App\Policies\ModulPolicy;
use App\Policies\OvlascenoLicePolicy;
use App\Policies\PartnerPolicy;
use App\Policies\PodKategorijaRobePolicy;
use App\Policies\PorezPolicy;
use App\Policies\PoslovnaJedinicaPolicy;
use App\Policies\PreduzecePolicy;
use App\Policies\ProizvodjacRobePolicy;
use App\Policies\RacunPolicy;
use App\Policies\RobaPolicy;
use App\Policies\TipAtributaPolicy;
use App\Policies\TipKorisnikaPolicy;
use App\Policies\UlazniRacunPolicy;
use App\Policies\UserPolicy;
use App\Policies\UslugaPolicy;
use App\Policies\ZiroRacunPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Preduzece::class => PreduzecePolicy::class,
        AtributRobe::class => AtributRobePolicy::class,
        CijenaRobe::class => CijenaRobePolicy::class,
        DepozitWithdraw::class => DepozitWithdrawPolicy::class,
        Djelatnost::class => DjelatnostPolicy::class,
        FizickoLice::class => FizickoLicePolicy::class,
        Grupa::class => GrupaPolicy::class,
        JedinicaMjere::class => JedinicaMjerePolicy::class,
        Kategorija::class => KategorijaPolicy::class,
        KategorijaRobe::class => KategorijaRobePolicy::class,
        Modul::class => ModulPolicy::class,
        OvlascenoLice::class => OvlascenoLicePolicy::class,
        Partner::class => PartnerPolicy::class,
        PodKategorijaRobe::class => PodKategorijaRobePolicy::class,
        Porez::class => PorezPolicy::class,
        PoslovnaJedinica::class => PoslovnaJedinicaPolicy::class,
        ProizvodjacRobe::class => ProizvodjacRobePolicy::class,
        Racun::class => RacunPolicy::class,
        Roba::class => RobaPolicy::class,
        TipKorisnika::class => TipKorisnikaPolicy::class,
        TipAtributa::class => TipAtributaPolicy::class,
        UlazniRacun::class => UlazniRacunPolicy::class,
        User::class => UserPolicy::class,
        Usluga::class => UslugaPolicy::class,
        ZiroRacun::class => ZiroRacunPolicy::class,
        Dokument::class => DokumentPolicy::class,
        KategorijaDokumenta::class => KategorijaDokumentaPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('superadmin');
        });
    }
}
