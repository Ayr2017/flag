<?php

use Illuminate\Support\Facades\Facade;

class MovieStorageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'moviestorage';
    }
}