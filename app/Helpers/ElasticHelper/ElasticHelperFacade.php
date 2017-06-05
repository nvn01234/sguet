<?php

namespace App\Helpers\ElasticHelper;


use Illuminate\Support\Facades\Facade;

class ElasticHelperFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'elastichelper';
    }
}