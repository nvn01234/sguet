<?php

namespace App\Console\Commands;

use App\Models\Contact;
use App\Models\Faq;
use Illuminate\Console\Command;

class IndexElasticCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:index {--type=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index Elastic';

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
        $types = $this->option('type');
        if (empty($types)) {
            $types = [
                'faq', 'contact'
            ];
        }

        if (in_array("faq", $types)) {
            \Elastic::indexFaqs(Faq::all());
        }

        if (in_array("contact", $types)) {
            \Elastic::indexContacts(Contact::all());
        }
    }
}
