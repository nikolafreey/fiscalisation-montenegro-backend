<?php

namespace App;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class RobaIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'robe';

    /**
     * @var array
     */
    protected $settings = [
        //
    ];
}