<?php

namespace App;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class UslugaIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'usluge';

    /**
     * @var array
     */
    protected $settings = [
        //
    ];
}