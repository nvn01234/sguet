<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EntrustServiceProvider extends \Zizaco\Entrust\EntrustServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('entrust.php'),
        ]);

        // Register commands
        $this->commands('command.entrust.migration');

        // Register blade directives
        $this->bladeDirectives();
    }

    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
        // Call to Entrust::hasRole
        \Blade::directive('role', function($expression) {
            return "<?php if (\\Entrust::hasRole({$expression})) : ?>";
        });

        \Blade::directive('elserole', function($expression) {
            return "<?php else : // Entrust::hasRole ?>";
        });

        \Blade::directive('endrole', function($expression) {
            return "<?php endif; // Entrust::hasRole ?>";
        });

        \Blade::directive('notrole', function($expression) {
            return "<?php if (!\\Entrust::hasRole({$expression})) : ?>";
        });

        \Blade::directive('endnotrole', function($expression) {
            return "<?php endif; // Entrust::hasRole ?>";
        });

        // Call to Entrust::can
        \Blade::directive('permission', function($expression) {
            return "<?php if (\\Entrust::can({$expression})) : ?>";
        });

        \Blade::directive('elsepermission', function($expression) {
            return "<?php else : // Entrust::can ?>";
        });

        \Blade::directive('endpermission', function($expression) {
            return "<?php endif; // Entrust::can ?>";
        });

        \Blade::directive('notpermission', function($expression) {
            return "<?php if (!\\Entrust::can({$expression})) : ?>";
        });

        \Blade::directive('endnotpermission', function($expression) {
            return "<?php endif; // Entrust::can ?>";
        });

        // Call to Entrust::ability
        \Blade::directive('ability', function($expression) {
            return "<?php if (\\Entrust::ability({$expression})) : ?>";
        });

        \Blade::directive('elseability', function($expression) {
            return "<?php else : // Entrust::ability ?>";
        });

        \Blade::directive('endability', function($expression) {
            return "<?php endif; // Entrust::ability ?>";
        });

        \Blade::directive('notability', function($expression) {
            return "<?php if (!\\Entrust::ability({$expression})) : ?>";
        });

        \Blade::directive('endnotability', function($expression) {
            return "<?php endif; // Entrust::ability ?>";
        });
    }
}
