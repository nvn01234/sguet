<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use URL;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as protected logoutTrait;
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        return route('home');
    }

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function username()
    {
        return 'username';
    }

    protected function authenticated(Request $request, $user)
    {
        \Toastr::append([
            'title' => 'Xin chào ' . $user->name,
            'message' => 'Bạn đã đăng nhập thành công',
            'level' => 'success',
        ]);
    }

    public function logout(Request $request)
    {
        /**
         * @var User $user
         */
        $user = \Auth::guard()->user();
        $this->logoutTrait($request);

        if ($user) {
            \Toastr::append([
                'title' => 'Tạm biệt ' . $user->name,
                'message' => 'Bạn đã đăng xuất',
                'level' => 'info',
            ]);
        }
        return redirect($this->redirectPath());
    }
}
