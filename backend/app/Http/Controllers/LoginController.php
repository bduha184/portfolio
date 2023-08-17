<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
class LoginController extends Controller
{
    //

    public function guestLogin() {
        $user = User::find(1);
        Auth::login($user);
        return response()->json([
            'message'=>'User Logged In Successfully'
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required','max:20'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (Auth::attempt($request->only(['email','password']))) {

            $user = User::where('email',$request->email)->first();
            $user->tokens()->delete();
            $token = $user->createToken("login:user{$user->id}")->plainTextToken;
            return response()->json([
                'status'=>true,
                'message'=>'User Logged In Successfully',
                'token'=>$token
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status'=>false,
            'message'=>'validation error',
            'errors'=>$validator->errors()
        ], Response::HTTP_INTERNAL_SERVER_ERROR);



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
            'user'=>false,
            'provider' => $provider,
            'email' => $providerUser->getEmail(),
            'token' => $providerUser->token,
        ]);


    }
}
