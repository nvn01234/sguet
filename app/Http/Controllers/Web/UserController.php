<?php

namespace App\Http\Controllers\Web;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:manage-user');
        $this->middleware('rolelevel:id')->only('edit', 'destroy');
    }

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.index');
    }

    public function create()
    {
        $roles = Role::lowerCurrentUser();
        return view('user.create', compact('roles'));
    }

    public function store(CreateUserRequest $request)
    {
        /**
         * @var Role $role
         */
        $role = Role::findOrFail($request->get('role_id'));
        $user = User::create(array_merge($request->only(['name', 'username']), [
            'password' => Hash::make($request->get('password'))
        ]));
        $user->attachRole($role);

        \Toastr::append([
            'title' => 'Thêm người dùng',
            'message' => 'Đã thêm ' . $role->display_name . ' ' . $user->name,
        ]);
        return redirect()->route('manage.user');
    }

    public function edit($id)
    {
        /**
         * @var User $user
         */
        $user = User::findOrFail($id);

        $roles = Role::lowerCurrentUser();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update($id, UpdateUserRequest $request)
    {
        /**
         * @var Role $role
         */
        $role = Role::findOrFail($request->get('role_id'));
        /**
         * @var User $user
         */
        $user = User::findOrFail($id);
        $user->update($request->only('name', 'username'));
        $user->syncRoles([$role->id]);

        if ($request->has('password')) {
            $user->update([
                'password' => Hash::make($request->get('password')),
            ]);
        }

        \Toastr::append([
            'title' => 'Thay đổi thông tin người dùng',
            'message' => 'Đã cập nhật ' . $role->display_name . ' ' . $user->name,
        ]);
        return redirect()->route('manage.user');
    }

    public function destroy($id)
    {
        /**
         * @var User $user
         */
        $user = User::findOrFail($id);

        $user->delete();
        /**
         * @var Role $role
         */
        $role = $user->roles()->first();
        $role_name = $role ? $role->display_name : 'Người dùng';
        \Toastr::append([
            'title' => 'Xoá người dùng thành công',
            'message' => 'Đã xoá ' . $role_name . ' ' . $user->name,
        ]);
        return redirect()->route('manage.user');
    }
}
