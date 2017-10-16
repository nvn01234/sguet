<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Faq;
use App\Models\Taggable;

class TaggableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        Article::each(function($article) {
            /**
             * @var Article $article
             */
            $taggable = Taggable::create();
            $article->update(['taggable_id' => $taggable->id]);
            $tags = $article->tags->pluck('id');
            $taggable->tags()->sync($tags);
        });

        Faq::each(function($faq) {
            /**
             * @var Faq $faq
             */
            $taggable = Taggable::create();
            $faq->update(['taggable_id' => $taggable->id]);
            $tags = $faq->tags->pluck('id');
            $taggable->tags()->sync($tags);
        });
        DB::commit();
    }
}
