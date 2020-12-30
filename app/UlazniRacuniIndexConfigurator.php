<?php

namespace App;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class UlazniRacuniIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'ulazni_racuni';

    /**
     * @var array
     */
    protected $settings = [
        //
    ];
}
