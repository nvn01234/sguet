<?php

use Illuminate\Database\Seeder;
use App\Models\Human;

class AcademicTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $file = File::get(database_path('data/academic_title.json'));
        $humansData = json_decode($file);

        foreach ($humansData as $humanData) {
            $names = collect(explode(' ', $humanData->name));
            $first_name = $names->last();
            $last_name = $names->slice(0, $names->count() - 1)->implode(' ');
            $human = Human::query()
                ->where('first_name', '=', $first_name)
                ->where('last_name', '=', $last_name)
                ->first();
            if ($human) {
                $human->update(['academic_title' => $humanData->academic_title]);
            }
        }

        DB::commit();
    }
}
