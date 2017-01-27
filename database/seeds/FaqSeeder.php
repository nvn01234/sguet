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

        /**
         * @var Category $faq
         */
        $faq = Category::firstOrNew(['name' => Category::NAME_FAQ]);
        $faq->save();

        foreach ($data as $obj) {
            $created_at = \Carbon\Carbon::createFromTimestamp($obj->created);
            $updated_at = \Carbon\Carbon::createFromTimestamp($obj->updated);

            \App\Article::insert(array([
                'id' => $obj->id,
                'title' => $obj->title,
                'body' => $obj->body,
                'short_description' => $obj->short_description,
                'category_id' => $faq->id,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]));
        }
    }
}
