<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if (preg_match('/\|/', $roles)) {
            $roles = explode('|', $roles);
        } else {
            $roles = [];
            $roles[] = $roles;
        }

        foreach ($roles as $role)
        {
            try {
                if (Auth::user()->role === 'administrator') {
                    return $next($request);
                }
            } catch (ModelNotFoundException $exception) {
                dd('Could not find role ' . $role);
            }
        }

        return redirect('/');
    }
}
