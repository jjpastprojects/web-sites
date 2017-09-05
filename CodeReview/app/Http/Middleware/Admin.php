<?php

namespace App\Http\Middleware;

use App\Facades\User;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(User::hasRole('admin'))
            return $next($request);
        return redirect('home');
    }
}
