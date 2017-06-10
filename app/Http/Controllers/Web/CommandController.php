<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\CommandArtisanRequest;
use App\Http\Requests\CommandShellRequest;
use App\Http\Controllers\Controller;

class CommandController extends Controller
{

    /**
     * ElasticCommandController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:manage-content');
    }

    public function shell_view() {
        return view('command.shell');
    }

    public function shell_exec(CommandShellRequest $request) {
        $cmd = $request->get('cmd');
        $response = shell_exec($cmd);
        return redirect()->route('manage.command.shell')->withInput(compact('cmd', 'response'));
    }

    public function artisan_view() {
        return view('command.artisan');
    }

    public function artisan_call(CommandArtisanRequest $request) {
        $cmd = $request->get('cmd');
        $params = $request->get('params');
        try {
            $params_decoded = (array)json_decode($params);
        } catch (\Exception $e) {
            $params_decoded = null;
        }
        if ($params_decoded) {
            \Artisan::call($cmd, $params_decoded);
        } else {
            \Artisan::call($cmd);
        }
        $response = \Artisan::output();
        return redirect()->route('manage.command.artisan')->withInput(compact('cmd', 'response', 'params'));
    }
}
