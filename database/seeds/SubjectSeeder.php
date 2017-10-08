<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('data/monhoc.json'));
        $datas = json_decode($json);

        DB::beginTransaction();
        foreach ($datas as $data) {
            Subject::create((array) $data);
        }
        DB::commit();
    }
}
