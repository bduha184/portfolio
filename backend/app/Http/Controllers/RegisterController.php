<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'password_confirmation' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        User::create([
            'name' =>  $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user = User::where('email',$request->email)->first();

        return response()->json([
            'user'=>$user->id,
            'User registration completed', Response::HTTP_OK
        ]);

    }

    public function registerProviderUser(Request $request, string $provider)
    {

        $request->validate([
            'name' => ['required', 'string', 'alpha_num', 'min:3', 'max:16', 'unique:users'],
            'token' => ['required', 'string'],
        ]);

        $token = $request->token;

        $providerUser = Socialite::driver($provider)->userFromToken($token);

        $user = User::create([
            'name' => $request->name,
            'email' => $providerUser->getEmail(),
            'password' => null,
        ]);

        Auth::login($user, true);

        return response()->json([
            'user'=>$user
        ]);
    }

}
