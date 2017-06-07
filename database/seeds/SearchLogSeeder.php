<?php

use Illuminate\Database\Seeder;

class SearchLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('data/search_logs_query.json'));
        $data = json_decode($json);

        foreach ($data as $obj) {
            $contacts_count = Elastic::searchContacts($obj->text)->count();

            \App\Models\SearchLog::create([
                'id' => $obj->id,
                'text' => $obj->text,
                'faqs_count' => $obj->faqs_count,
                'contacts_count' => $contacts_count,
                'created_at' => $obj->created_at,
                'updated_at' => $obj->updated_at,
                'ip' => $obj->ip,
            ]);
        }
    }
}
