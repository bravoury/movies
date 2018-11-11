<?php

namespace Movies\Movies\Facades;

use Illuminate\Support\Facades\Facade;

class Movies extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'movies';
    }
}
