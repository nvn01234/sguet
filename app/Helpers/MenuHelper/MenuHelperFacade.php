<?php

namespace App\Helpers\MenuHelper;


use Illuminate\Support\Facades\Facade;

class MenuHelperFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'menuhelper';
    }
}