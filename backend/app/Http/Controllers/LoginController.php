<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Laravel\Socialite\Facades\Socialite;
class LoginController extends Controller
{
    //

    public function login(Request $request)
    {
        // $credentials = $request->validate([
        //     'name' => 'required',
        //     // 'password' => 'required'
        // ]);

        // if (Auth::attempt($request)) {
        //     $user = User::whereName($request->name)->first();

        //     $user->tokens()->delete();
        //     // $token = $user->createToken("login:user{$user->id}")->plainTextToken;

        //     return $user;
        // }
        return response('test');

        // return response()->json('User Not Found.', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(Response::HTTP_OK);
    }

    public function redirectToProvider(string $provider)
    {
        $redirectUrl =  Socialite::driver($provider)->redirect()->getTargetUrl();

        return response()->json([
            'redirect_url' => $redirectUrl,
        ]);
    }

    public function handleProviderCallback(Request $request, string $provider)
    {
        $providerUser = Socialite::driver($provider)->stateless()->user();

        $user = User::where('email', $providerUser->getEmail())->first();


        if ($user) {
            Auth::login($user);
            return  response()->json([
                'user'=>$user,
            ]);
        }

        return response()->json([
            'provider' => $provider,
            'email' => $providerUser->getEmail(),
            'token' => $providerUser->token,
        ]);
    }
}
