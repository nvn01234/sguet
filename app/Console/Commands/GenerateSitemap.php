<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Contact;
use App\Models\Faq;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapIndex;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // modify this to your own needs
        /**
         * @var SitemapIndex $sitemap
         */
        $sitemap = SitemapIndex::create();

        $sitemap = $sitemap
            ->add(route('home'))
            ->add(route('articles'))
            ->add(route('contact.index'))
            ->add(route('about'))
            ->add(route('feedback.create'))
            ->add(route('links'))
        ;

        foreach (Faq::all() as $faq) {
            $sitemap = $sitemap->add(route('faq.slug', $faq->slug));
        }

        foreach (Article::all() as $article) {
            $sitemap = $sitemap->add(route('articles.slug', $article->slug));
        }

        foreach (Contact::all() as $contact) {
            $sitemap = $sitemap->add(route('contact.slug', $contact->slug));
        }

        $sitemap->writeToFile(storage_path('sitemap.xml'));
        $this->info("done");
    }
}
