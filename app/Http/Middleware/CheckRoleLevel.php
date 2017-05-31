<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class CheckRoleLevel
{
    protected $auth;

    /**
     * Creates a new instance of the middleware.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $routeParam
     * @return mixed
     */
    public function handle($request, Closure $next, $routeParam)
    {
        if ($this->auth->guest()) {
            abort(403);
        }

        $id = \Route::current()->getParameter($routeParam);
        /**
         * @var User $user
         */
        $user = User::findOrFail($id);
        /**
         * @var User $current
         */
        $current = $this->auth->user();

        if ($user->roleLevel() > $current->roleLevel()) {
            abort(403);
        }

        return $next($request);
    }
}
