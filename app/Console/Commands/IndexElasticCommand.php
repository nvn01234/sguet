<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class IndexElasticCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic {method}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elastic console';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $method = $this->argument('method');
        $response = \Elastic::$method();
        $this->info($response);
    }
}
