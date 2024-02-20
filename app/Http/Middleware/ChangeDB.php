<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Token;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Laravel\Passport\Exceptions\AuthenticationException;

class ChangeDB
{
    public function handle(Request $request, Closure $next, ...$scopes)
    {   

        //old code
        $companyName = auth()->user()->company->name;
        // Config::set('database.default', $connectionName);
        $getHost = request()->getHost();

        if ($getHost == 'company_two.wcg' || $companyName == 'company_2') {
            Config::set('database.default', 'company_2');
        } else if ($getHost == 'company_one.wcg' || $companyName == 'company_1') {
            Config::set('database.default', 'company_1');
        } else {
            abort(403, 'Unauthorized access.');
        }


        return $next($request);
    }
}