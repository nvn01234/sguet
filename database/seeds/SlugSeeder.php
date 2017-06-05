<?php

use Illuminate\Database\Seeder;

class SlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->slugArticles();
        $this->slugCategories();
        $this->slugContacts();
        $this->slugFaqs();
        $this->slugTags();
    }

    private function slugArticles() {
        \App\Models\Article::all()->each(function($article) {
            /**
             * @var \App\Models\Article $article
             */
            $article->update([
                'slug' => \Cviebrock\EloquentSluggable\Services\SlugService::createSlug(\App\Models\Article::class, 'slug', $article->title)
            ]);
        });
    }

    private function slugCategories() {
        \App\Models\Category::all()->each(function($category) {
            /**
             * @var \App\Models\Category $category
             */
            $category->update([
                'slug' => \Cviebrock\EloquentSluggable\Services\SlugService::createSlug(\App\Models\Category::class, 'slug', $category->name)
            ]);
        });
    }

    private function slugContacts() {
        \App\Models\Contact::all()->each(function($contact) {
            /**
             * @var \App\Models\Contact $contact
             */
            $contact->update([
                'slug' => \Cviebrock\EloquentSluggable\Services\SlugService::createSlug(\App\Models\Contact::class, 'slug', $contact->name)
            ]);
        });
    }

    private function slugFaqs() {
        \App\Models\Faq::all()->each(function($faq) {
            /**
             * @var \App\Models\Faq $faq
             */
            $faq->update([
                'slug' => \Cviebrock\EloquentSluggable\Services\SlugService::createSlug(\App\Models\Faq::class, 'slug', $faq->question)
            ]);
        });
    }

    private function slugTags() {
        \App\Models\Tag::all()->each(function($tag) {
            /**
             * @var \App\Models\Tag $tag
             */
            $tag->update([
                'slug' => \Cviebrock\EloquentSluggable\Services\SlugService::createSlug(\App\Models\Tag::class, 'slug', $tag->name)
            ]);
        });
    }
}
