<?php

namespace Database\Factories;

use App\Models\JedinicaMjere;
use App\Models\Porez;
use App\Models\Racun;
use App\Models\StavkaRacuna;
use App\Models\User;
use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\Factory;

class StavkaRacunaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StavkaRacuna::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $porez = Porez::all()->random(); // 0.21
        $jedinicna_cijena_bez_pdv = $this->faker->randomFloat(2, 0, 100); // 41.00
        $kolicina = $this->faker->randomFloat(2, 0, 100); // 10.00
        $popust_procenat = $this->faker->randomFloat(2, 0, 100); // 50.00
        $popust_na_jedinicnu_cijenu = $this->faker->randomFloat(2, 0, $jedinicna_cijena_bez_pdv); // 10.00

        if ($popust_procenat) {
            $popust_iznos = 1.17*$kolicina*$popust_procenat/100*$jedinicna_cijena_bez_pdv;

            $pdv_iznos = $jedinicna_cijena_bez_pdv*(1-$popust_procenat/100)*$kolicina*0.17;

            $cijena_bez_pdv = $jedinicna_cijena_bez_pdv * $kolicina*(1-$popust_procenat/100);

            $cijena_sa_pdv = $cijena_bez_pdv *1.17;

        } else {
            $popust_iznos = $popust_na_jedinicnu_cijenu * $kolicina;

            $pdv_iznos =($kolicina*($jedinicna_cijena_bez_pdv - $popust_iznos / 1.17) * 1.17) - ($kolicina * ($jedinicna_cijena_bez_pdv - $popust_iznos / 1.17) * 1.17) / 1.17;

            $cijena_bez_pdv = $kolicina*($jedinicna_cijena_bez_pdv-($popust_iznos/(1+0.17)));

            $cijena_sa_pdv = $kolicina*($jedinicna_cijena_bez_pdv+$pdv_iznos/1.17);

        }

        return [
            'naziv' => $this->faker->words(3, true),
            'opis' => $this->faker->text(),
            'jedinicna_cijena_bez_pdv' => $jedinicna_cijena_bez_pdv,
            'cijena_bez_pdv' => $cijena_bez_pdv,
            'kolicina' => $kolicina,
            'popust_procenat' => $popust_procenat,
            'popust_na_jedinicnu_cijenu' => $popust_na_jedinicnu_cijenu,
            'pdv_iznos' => $pdv_iznos,
            'popust_iznos' => $popust_iznos,
            'cijena_sa_pdv' => $cijena_sa_pdv,
            'porez_id' => $porez->id,
            'jedinica_id' => JedinicaMjere::all()->random()->id,
        ];
    }
}
