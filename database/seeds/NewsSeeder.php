<?php

use Illuminate\Database\Seeder;
use App\Category;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('data/news.json'));
        $data = json_decode($json);

        /**
         * @var Category $news
         */
        $news = Category::create(['name' => Category::NAME_NEWS]);

        foreach ($data as $obj) {
            $created_at = \Carbon\Carbon::createFromTimestamp($obj->created);
            $updated_at = \Carbon\Carbon::createFromTimestamp($obj->updated);
            $short_description = $obj->short_description;
            if (!$short_description) $short_description = '';

            \App\Models\Article::create([
                'id' => $obj->id,
                'title' => $obj->title,
                'body' => $obj->body,
                'image_url' => $obj->image_url,
                'short_description' => $short_description,
                'category_id' => $news->id,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]);
        }
    }
}
