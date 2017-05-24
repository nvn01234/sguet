<?php

namespace App\Providers;

use App\Helpers\MenuHelper\MenuHelper;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class MenuHelperProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bladeDirectives();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMenuHelper();
    }

    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
        \Blade::directive('activeroute', function($expression) {
            return "<?php if (\\MenuHelper::currentRouteNamedIn({$expression})) {echo 'active';} ?>";
        });
    }

    private function registerMenuHelper()
    {
        $this->app->bind('menuhelper', function ($app) {
            /**
             * @var Application $app
             */
            $router = $app->make('router');
            return new MenuHelper($router);
        });

        $this->app->alias('menuhelper', 'App\Helpers\MenuHelper\MenuHelper');
    }
}
