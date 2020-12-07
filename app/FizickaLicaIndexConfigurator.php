<?php

namespace App;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class FizickaLicaIndexConfigurator extends IndexConfigurator
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