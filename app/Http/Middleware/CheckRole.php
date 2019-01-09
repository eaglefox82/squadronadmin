<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if($request->user() == null)
            return redirect(url('/login'));

        if ($request->user()->hasAnyRole($roles) || !$roles)
            return $next($request);

        //Default end case - Redirect to squadron
        return redirect(url('/squadron'));
    }
}
