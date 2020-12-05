<?php

namespace App;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class PreduzecaIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'preduzeca';

    /**
     * @var array
     */
    protected $settings = [
        //
    ];
}