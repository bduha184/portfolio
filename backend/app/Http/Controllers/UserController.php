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


    public function register(Request $request) {

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

        $user = User::where('email',$request->email)->first();

        Auth::login($user, true);

        return response()->json([
            'user'=>$user,
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


    public function show()
    {
        $users =  User::all();

        $articles = $users->each(function ($e) {
            $e->articles->sortByDesc('created_at');
        });
        // $articles = $users->articles->sortByDesc('crated_at');

        return [
            // 'users'=>$users,
            'articles' => $articles
        ];
    }

    public function followers(string $name)
    {
        $user = User::where('name', $name)->first();
        if ($user) {
            $followers = $user->followers->sortByDesc('created_at');
            return response()->json([
                'followers' => $followers
            ], Response::HTTP_OK);
        }

        return response()->json(Response::HTTP_NOT_FOUND);
    }

    public function followees(string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user) {
            $followees = $user->followees->sortByDesc('created_at');

            return response()->json([
                'followees' => $followees
            ], Response::HTTP_OK);
        }

        return response()->json(Response::HTTP_NOT_FOUND);
    }

    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        $request->user()->followees()->detach($user);
        $request->user()->followees()->attach($user);

        return ['name' => $name];
    }
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        $request->user()->followees()->detach($user);

        return ['name' => $name];
    }

    public function likes($id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            $likes_articles = $user->likes->all();
            $articleArray = [];

            foreach ($likes_articles as $likes_article) {
                $article = Article::where('id', $likes_article->id)->with('user')->get();
                array_push($articleArray, $article);
            }
            return $articleArray;
        }
        return response()->json(Response::HTTP_NOT_FOUND);
    }
}
