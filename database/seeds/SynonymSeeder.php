<?php

use Illuminate\Database\Seeder;

class SynonymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('data/synonyms.json'));
        $data = json_decode($json);

        foreach ($data as $str) {
            \App\Models\Synonym::create([
                'synonyms' => $str
            ]);
        }
    }
}
