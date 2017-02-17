<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Role;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.index');
    }

    public function create()
    {
        $roles = Role::all();
        $selected_role = $roles->last();
        return view('user.create', compact('roles', 'selected_role'));
    }

    public function store(Request $request)
    {
        $roles = Role::pluck('id')->toArray();

        $validator = \Validator::make($request->all(), [
            'name' => 'string|required|max:255',
            'username' => 'string|required|max:255|unique:users',
            'password' => 'string|confirmed|required|max:255',
            'role_id' => [
                'integer', 'required',
                Rule::in($roles)
            ]
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        /**
         * @var Role $role
         */
        $role = Role::findOrFail($request->get('role_id'));
        $user = User::create(array_merge($request->only(['name', 'username']), [
            'password' => Hash::make($request->get('password'))
        ]));
        $user->attachRole($role);

        \Session::flash('toastr', [
            [
                'title' => 'Tạo người dùng',
                'message' => 'Đã tạo ' . $role->display_name . ' ' . $user->name,
            ]
        ]);
        return redirect()->route('manage.user');
    }

    public function edit($id) {
        /**
         * @var User $user
         */
        $user = User::findOrFail($id);
        $roles = Role::all();
        $role = $user->roles()->first();
        $selected_role = $role ? $role : $roles->last();
        return view('user.edit', compact('user', 'roles', 'role', 'selected_role'));
    }

    public function update($id, Request $request)
    {
        $roles = Role::pluck('id')->toArray();

        $validator = \Validator::make($request->all(), [
            'name' => 'string|required|max:255',
            'username' => [
                'string', 'required', 'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'role_id' => [
                'integer', 'required',
                Rule::in($roles)
            ]
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

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

        \Session::flash('toastr', [
            [
                'title' => 'Sửa thông tin người dùng',
                'message' => 'Đã cập nhật ' . $role->display_name . ' ' . $user->name,
            ]
        ]);
        return redirect()->route('manage.user');
    }

    public function destroy($id) {
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
        \Session::flash('toastr', [
            [
                'title' => 'Xoá người dùng',
                'message' => 'Đã xoá ' . $role_name . ' ' . $user->name,
            ]
        ]);
        return redirect()->route('manage.user');
    }
}
