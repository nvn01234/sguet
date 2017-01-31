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
        $json = File::get(database_path('data/faq.json'));
        $data = json_decode($json);

        foreach ($data as $obj) {
            $created_at = \Carbon\Carbon::createFromTimestamp($obj->created);
            $updated_at = \Carbon\Carbon::createFromTimestamp($obj->updated);

            \App\Faq::create([
                'id' => $obj->id,
                'question' => $obj->title,
                'answer' => $obj->body,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]);
        }
    }
}
