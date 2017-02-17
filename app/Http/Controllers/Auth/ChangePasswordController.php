<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChangePasswordController extends Controller
{
    /**
     * ChangePasswordController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();
        return view('auth.passwords.change', compact('user'));
    }

    public function change(Request $request)
    {
        $user = Auth::user();

        $validator = \Validator::make($request->all(), [
            'remember_token' => [
                'string', 'required', 'max:255',
                Rule::in([$user->remember_token])
            ],
            'old_password' => 'string|required|max:255',
            'password' => 'string|confirmed|required|max:255'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (!Hash::check($request->get('old_password'), $user->password)) {
            return back()->withErrors([
                'old_password.match' => 'Sai mật khẩu cũ'
            ])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->get('password')),
            'remember_token' => str_random(60)
        ]);
        \Session::flash('toastr', [
            [
                'title' => 'Đổi mật khẩu',
                'message' => 'Đổi mật khẩu thành công',
                'level' => 'success'
            ]
        ]);
        return redirect()->route('home');
    }
}
