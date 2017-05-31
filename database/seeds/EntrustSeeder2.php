<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class EntrustSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = Role::create([
            'name' => 'superadmin',
            'display_name' => 'Quản trị hệ thống',
            'level' => 3,
        ]);

        $nvn = User::whereUsername('nhatnv')->first();
        $nvn->syncRoles([$superadmin->id]);

        $admin = Role::findByName('admin');
        $admin->update(['level' => 2]);

        $editor = Role::findByName('editor');
        $editor->update(['level' => 1]);

        $manage_user = Permission::create([
            'name' => 'manage-user',
            'display_name' => 'Quản lý người dùng',
        ]);
        $manage_user->syncRoles([$superadmin->id, $admin->id]);

        $manage_content = Permission::create([
            'name' => 'manage-content',
            'display_name' => 'Quản lý nội dung',
        ]);
        $manage_content->syncRoles([$superadmin->id, $admin->id, $editor->id]);

        $manage_system = Permission::create([
            'name' => 'manage-system',
            'display_name' => 'Quản lý hệ thống',
        ]);
        $manage_system->syncRoles([$superadmin->id]);
    }
}
