<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Role;
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

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {

    }

}
