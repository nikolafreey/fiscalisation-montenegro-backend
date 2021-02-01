<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Preduzece;

class PreduzeceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Preduzece::factory(200)->create();
    }
}
