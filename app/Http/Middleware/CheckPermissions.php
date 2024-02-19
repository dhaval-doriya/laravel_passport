<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Passport\Exceptions\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!$request->user() || !$request->user()->token()) {
            throw new AuthenticationException();
        }

        $routeName = $request->route()->getName();

        if ($request->user()->tokenCan($routeName)) {
            return $next($request);
        }
        abort(403, 'Unauthorized Permission access.');
    }
}
