<?php

namespace App\Providers;

use App\Helpers\Toastr\Toastr;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ToastrProvider extends ServiceProvider
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
        $this->registerToastr();
    }

    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
        \Blade::directive('toastr', function($expression) {
            return "<?php echo \\Toastr::scriptAsync({$expression}) ?>";
        });
    }

    private function registerToastr()
    {
        $this->app->bind('toastr', function ($app) {
            /**
             * @var Application $app
             */
            $session = $app->make('session.store');
            return new Toastr($session);
        });

        $this->app->alias('toastr', 'App\Helpers\Toastr\Toastr');
    }
}
