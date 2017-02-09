<?php

namespace App\Http\Controllers;

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
        }

        return view('user.index');
    }
}
