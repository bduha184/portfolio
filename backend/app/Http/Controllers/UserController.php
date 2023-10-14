<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function register(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'password_confirmation' => ['required']
        ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        // }
        User::create([
            'name' =>  $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user = User::where('email', $request->email)->first();

        Auth::login($user, true);

        return response()->json([
            'user' => $user,
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
            'user' => $user
        ]);
    }

    public function show($id)
    {

        $user = User::where('id',$id)->first();

        if ($user) {
            return response()->json([
                'user' => $user
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }


    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json([
                'message' => 'delete successfully'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
