<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfIsOfType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        if (
            auth()->check() &&
            auth()
                ->user()
                ->is($type)
        ) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}