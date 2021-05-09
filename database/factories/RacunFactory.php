<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Racun;
use App\Models\Partner;
use App\Models\Preduzece;
use App\Models\PoslovnaJedinica;
use Illuminate\Database\Eloquent\Factories\Factory;

class RacunFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Racun::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ikof' => $this->faker->lexify('???????????'),
            'jikr' => $this->faker->lexify('???????????'),
            'tip_racuna' => $this->faker->randomElement([Racun::RACUN, Racun::PREDRACUN]),
            'vrsta_racuna' => $this->faker->randomElement(['gotovinski', 'bezgotovinski']),
            'korektivni_racun' => $this->faker->boolean(),
            'korektivni_racun_vrsta' => $this->faker->randomElement(['CORRECTIVE', 'DEBIT', 'CREDIT']),
            'nacin_placanja' => $this->faker->randomElement(['BANKNOTE', 'CARD', 'ORDER', 'OTHER-CASH', 'BUSINESSCARD', 'SVOUCHER', 'COMPANY', 'ADVANCE', 'ACCOUNT', 'FACTORING', 'OTHER']),
            'broj_racuna' => $this->faker->randomNumber(),
            'datum_izdavanja' => $this->faker->date(),
            'datum_za_placanje' => $this->faker->date(),
            // 'kod_poslovnog_prostora_enu' => $this->faker->asciify('***********'),
            'ukupna_cijena_bez_pdv' => $this->faker->randomFloat(2, 0, 100),
            'ukupna_cijena_sa_pdv' => $this->faker->randomFloat(2, 0, 100),
            'ukupan_iznos_pdv' => $this->faker->randomFloat(2, 0, 100),
            'popust_procenat' => $this->faker->randomFloat(2, 0, 100),
            'popust_iznos' => $this->faker->randomFloat(2, 0, 100),
            'popust_na_cijenu_bez_pdv' => $this->faker->randomFloat(2, 0, 100),
            'offline' => rand(0, 1),
            'order' => rand(0, 1),
            'popust_ukupno' => $this->faker->randomFloat(2, 0, 100),
            'opis' => $this->faker->text(),
            'status' => $this->faker->randomElement(['placen', 'nenaplativ', 'nijeplacen', 'privremeni']),
            'user_id' => User::all()->random()->id,
            'partner_id' => Partner::all()->random()->id,
        ];
    }
}
