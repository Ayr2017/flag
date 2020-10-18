<?php

use Illuminate\Support\Facades\Facade;

class MovieServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'movieservice';
    }
}