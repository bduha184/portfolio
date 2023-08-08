<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Article;


class UserController extends Controller
{

    public function test()
    {
        $users =  User::all();

        return $users;
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
