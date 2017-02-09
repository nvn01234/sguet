<?php

use App\Role;
use Illuminate\Database\Seeder;
use App\Permission;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'display_name' => 'Quản trị viên'
        ]);

        Role::create([
            'name' => 'editor',
            'display_name' => 'Biên tập viên'
        ]);
    }
}
