<?php

namespace App\Providers;

use App\Helpers\ElasticHelper\ElasticHelper;
use Elasticsearch\ClientBuilder;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ElasticHelperProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerElasticHelper();
    }

    private function registerElasticHelper()
    {
        $this->app->bind('elastichelper', function ($app) {
            /**
             * @var Application $app
             */
            $hosts = config('elastic.host');

            $client = ClientBuilder::create()
                ->setHosts($hosts)// Set the hosts
                ->build();
            return new ElasticHelper($client);
        });

        $this->app->alias('elastichelper', 'App\Helpers\ElasticHelper\ElasticHelper');
    }
}
