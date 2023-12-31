<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{


    public function register(StoreUserRequest $request)
    {

        try{
            DB::transaction(function () use ($request) {

                User::create([
                    'name' =>  $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'password_confirmation' => Hash::make($request->password_confirmation),
                ]);

                $user = User::where('email', $request->email)->first();
                Auth::login($user, true);
                return response()->json([
                    'user' => $user,
                    'User registration completed', Response::HTTP_OK
                ]);
            });

        }catch(\Exception $e){
            return response()->json([
                'errors' => $e,
            ]);

        }

    }

    public function registerProviderUser(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'alpha_num', 'min:3', 'max:16', 'unique:users'],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
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
