<?php

namespace App;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class RacuniIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'racuni';

    /**
     * @var array
     */
    protected $settings = [
        //
    ];
}