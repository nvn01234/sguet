<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query()
                ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
                ->select([
                    'users.id as id',
                    'users.username as username',
                    'users.name as name',
                    'roles.display_name as role_name',
                    'users.created_at as created_at',
                    'users.updated_at as updated_at',
                ]);
            return \Datatables::of($users)
                ->make(true);
        }

        return view('user.index');
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
    }

}
