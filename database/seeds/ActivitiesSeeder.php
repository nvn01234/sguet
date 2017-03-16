<?php

use Illuminate\Database\Seeder;
use App\Category;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('data/activities.json'));
        $data = json_decode($json);

        /**
         * @var Category $act
         */
        $act = Category::create(['name' => Category::NAME_ACTIVITIES]);

        foreach ($data as $obj) {
            $created_at = \Carbon\Carbon::createFromTimestamp($obj->created);
            $updated_at = \Carbon\Carbon::createFromTimestamp($obj->updated);
            $short_description = $obj->short_description;
            if (!$short_description) $short_description = '';

            \App\Article::create([
                'id' => $obj->id,
                'title' => $obj->title,
                'body' => $obj->body,
                'image_url' => $obj->image_url,
                'short_description' => $short_description,
                'category_id' => $act->id,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]);
        }

    }
}