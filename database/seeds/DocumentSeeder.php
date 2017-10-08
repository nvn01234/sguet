<?php

use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('data/van-ban.json'));
        $data = json_decode($json);

        DB::beginTransaction();
        foreach ($data as $d) {
            Document::create((array)$d);
        }
        DB::commit();
    }
}
