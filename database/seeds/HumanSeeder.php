<?php

use Illuminate\Database\Seeder;
use App\Models\Human;
use App\Models\Department;

class HumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $files = File::files(database_path('data/humans_departments'));
        foreach ($files as $path) {
            $file = File::get($path);
            $department_id = intval(str_replace('.json', '', collect(explode('/', $path))->last()));
            $department = Department::findOrFail($department_id);
            $humansData = json_decode($file);
            foreach ($humansData as $humanData) {
                $names = collect(explode(' ', $humanData->name));
                $first_name = $names->last();
                $last_name = $names->slice(0, $names->count() - 1)->implode(' ');
                $position = $humanData->position;

                /**
                 * @var Human $human
                 */
                $human = Human::firstOrCreate(compact('first_name', 'last_name'));
                $human->departments()->attach($department, ['position' => $position]);
            }
        }

        DB::commit();
    }
}
