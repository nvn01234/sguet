<?php

use Illuminate\Database\Seeder;
use App\Models\Department;
use Illuminate\Support\Collection;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('data/departments2.json'));
        $departments = json_decode($json);

        DB::beginTransaction();
        $this->createDepartments($departments);
        DB::commit();
    }

    /**
     * @param Collection $departments
     * @param null|integer $parent_id
     */
    private function createDepartments($departments, $parent_id = null) {
        foreach ($departments as $department) {
            /**
             * @var Department $d
             */
            $d = Department::create(['name' => $department->name, 'parent_id' => $parent_id]);
            $this->createDepartments($department->children, $d->id);
        };
    }
}
