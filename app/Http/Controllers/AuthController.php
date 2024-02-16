<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $accessToken = $user->createToken('AuthToken')->accessToken;

        return response()->json(['user' => $user, 'access_token' => $accessToken]);
    }


    public function login(Request $request)
    {   
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $scopes = $user->permissions();
            $generatedToken = $user->createToken('AuthToken', $scopes ?? []);
            return response()->json([ 'type'=>'success', 'message' => 'You are successfully logged in' ,'user' => $user, 'access_token' => $generatedToken->accessToken ,'expires_at' => $generatedToken->token->expires_at,]);
        } else {
            return response()->json(['type'=>'error', 'message' => 'Unauthorized'], 401);
        }
    }


    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => __($status)])
            : response()->json(['error' => __($status)], 400);
    }



    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? response()->json(['message' => __($status)])
            : response()->json(['error' => __($status)], 400);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json(['type' => 'sucess', 'access_token' => 'You have successfully logged out!']);

    }


    public function oauth(Request $request)
    {
        $data = [
            'grant_type' => $request->input('grant_type'),
            'client_id' => $request->input('client_id'),
            'client_secret' => $request->input('client_secret'),
            'provider' => $request->input('provider'),
            'access_token' => $request->input('access_token')
        ];
        $url = route('passport.token');
        $request->request->add($data);
        $tokenRequest = $request->create(
            $url,
            'post',
        );
        $instance = Route::dispatch($tokenRequest);
        return $instance;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {   
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();
        if(!$user)
        {
            $user = User::create(['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => \Hash::make(rand(100000,999999))]);
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
