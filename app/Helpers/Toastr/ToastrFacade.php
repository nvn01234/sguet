<?php
/**
 * Created by PhpStorm.
 * User: nguye
 * Date: 5/21/2017
 * Time: 9:48 PM
 */

namespace App\Helpers\Toastr;


use Illuminate\Support\Facades\Facade;

class ToastrFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'toastr';
    }
}