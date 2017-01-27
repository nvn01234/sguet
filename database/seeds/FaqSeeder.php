<?php

use Illuminate\Database\Seeder;
use App\Category;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('data/faq.json'));
        $data = json_decode($json);
        $cat = Category::whereName(Category::NAME_FAQ)->first(['id'])->id;
        foreach ($data as $obj) {
            $created_at = \Carbon\Carbon::createFromTimestamp($obj->created);
            $updated_at = \Carbon\Carbon::createFromTimestamp($obj->updated);

            \App\Article::insert(array([
                'id' => $obj->id,
                'title' => $obj->title,
                'body' => $obj->body,
                'short_description' => $obj->short_description,
                'category_id' => $cat,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]));
        }
    }
}
