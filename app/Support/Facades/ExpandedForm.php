<?php

namespace FireflyIII\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Amount
 *
 * @package FireflyIII\Support\Facades
 */
class ExpandedForm extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'expandedform';
    }

}