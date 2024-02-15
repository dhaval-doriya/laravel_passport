<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Passport\Token;
use Symfony\Component\HttpFoundation\Response;

class CheckPassportScopes
{
    public function handle(Request $request, Closure $next, ...$scopes)
    {   

        // Check if the Authorization header exists
        // if (!$request->header('Authorization')) {
        // return response()->json(['error' => 'Authorization header is missing'], 401);
        // }

        // // Extract the access token from the Authorization header
        // $accessToken = str_replace('Bearer ', '', $request->header('Authorization'));

        // // Pass the access token to the request for later use
        // $request->merge(['access_token' => $accessToken]);

        // $accessToken = $request->bearerToken();

        // $token = Token::where('id', $accessToken)->first();

        // // Check if the token exists
        // if (!$token) {
        //     return response()->json([ 'type' => 'error' , 'message' => 'Invalid access token'], 401);
        // }

        // dd($accessToken);

        // if (!$request->user() || !$request->user()->token() || !$request->user()->token()->scopes()) {
        //     return response()->json([ 'type' => 'error','message' => 'Unauthorized'], 401);
        // }

        // foreach ($scopes as $scope) {
        //     if (!$request->user()->tokenCan($scope)) {
        //         return response()->json([ 'type' => 'error','message' => 'Access Forbidden'], 403);
        //     }
        // }

        return $next($request);
    }
}