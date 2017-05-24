<?php

namespace App\Helpers\MenuHelper;

use Illuminate\Routing\Router;

class MenuHelper
{
    /**
     * @var Router $router
     */
    public $router;

    /**
     * MenuHelper constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param string|mixed $names
     * @return bool
     */
    public function currentRouteNamedIn($names) {
        $names = is_array($names) ? $names : func_get_args();
        return in_array($this->router->currentRouteName(), $names);
    }
}