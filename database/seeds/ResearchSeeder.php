<?php

use App\Models\Human;
use Illuminate\Database\Seeder;
use App\Models\Research;

class ResearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $this->seed(database_path('data/huong_nghien_cuu/data1.json'));

        DB::commit();
    }

    private function seed($path) {
        $file = File::get($path);
        $researchesData = json_decode($file);

        foreach ($researchesData as $researchData) {
            $names = collect(explode(' ', $researchData->name));
            $first_name = $names->last();
            $last_name = $names->slice(0, $names->count() - 1)->implode(' ');

            /**
             * @var Human $human
             */
            $human = Human::query()
                ->where('first_name', '=', $first_name)
                ->where('last_name', '=', $last_name)
                ->first();
            if ($human) {
                $research = Research::create([
                    'human_id' => $human->id,
                    'research' => $researchData->research,
                ]);
            }
        }
    }
}
