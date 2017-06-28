<?php namespace DevHouse;

class DevHouseFacade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'DevHouse';
    }
}
