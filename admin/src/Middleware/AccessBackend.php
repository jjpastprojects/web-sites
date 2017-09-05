<?php

namespace Lembarek\Admin\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccessBackend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $roles = $request->user()->roles()->get();
        foreach($roles as $role){
            if ( $role->hasPermission('access-backend') )
                return $next($request);
        }

        return redirect('/');
    }
}
