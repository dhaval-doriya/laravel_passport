<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Laravel\Passport\Token;
use Symfony\Component\HttpFoundation\Response;

class Check
{
    public function handle(Request $request, Closure $next, ...$scopes)
    {   

        $connectionName = auth()->user()->company->name;
        Config::set('database.default', $connectionName);

        return $next($request);
    }
}