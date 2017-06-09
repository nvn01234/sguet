<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\ExecRequest;
use App\Http\Controllers\Controller;

class ExecController extends Controller
{


    /**
     * ExecController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:manage-system');
    }

    public function view() {
        return view('exec.exec');
    }

    public function run(ExecRequest $request) {
        $cmd = $request->get('cmd');
        $response = shell_exec($request->get('cmd'));
        return back()->withInput(compact('cmd', 'response'));
    }
}
