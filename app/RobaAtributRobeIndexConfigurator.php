<?php

namespace App;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class RobaAtributRobeIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'roba_atribut_robe';

    /**
     * @var array
     */
    protected $settings = [
        //
    ];
}