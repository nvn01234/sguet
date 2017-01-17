<?php

use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('json/faq.json'));
        $data = json_decode($json);
        $cat = \App\Category::whereName('Q&A')->first(['id'])->id;
        foreach ($data as $obj) {
            \App\Article::insert(array([
                'id' => $obj->id,
                'title' => $obj->title,
                'body' => $obj->body,
                'image_url' => $obj->image_url,
                'short_description' => $obj->short_description,
                'category_id' => $cat
            ]));
        }
    }
}
