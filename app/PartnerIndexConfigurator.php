<?php

namespace App;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class PartnerIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = 'partneri';

    /**
     * @var array
     */
    protected $settings = [
        //
    ];
}