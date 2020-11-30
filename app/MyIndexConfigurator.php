<?php

namespace App;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class MyIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'fizicka_lica';

    /**
     * @var array
     */
    protected $settings = [
        //
    ];
}