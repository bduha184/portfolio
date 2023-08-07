<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Tag;
use ArithmeticError;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page)
    {
        return Article::latest()->with(['user', 'tags', 'likes'])->offset($page*10-1)->limit(10)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request, Article $article)
    {

        $article->fill($request->all());
        $article->user_id = Auth::id();
        $article->save();


        collect($request->tags)->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });

        return response()->json([
            'message' => 'created successfully'
        ], Response::HTTP_CREATED);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request,$id)
    {
        $article = Article::find($id);
        $article->fill($request->all())->save();
        $article->tags()->detach();

        collect($request->tags)->each(function ($tagName) use ($article) {
            $tag = Tag::updateOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });

        return response()->json([
            'message' => 'update successfully'
        ], Response::HTTP_OK);

    }
    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->delete();
            return response()->json([
                'message' => 'update successfully'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'Article not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function like(Request $request, $id)
    {

        $article = Article::find($id)->likes();

        if ($article) {
            $article->detach($request->user()->id);
            $article->attach($request->user()->id);
            return response()->json(Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Article not found'
        ], Response::HTTP_NOT_FOUND);
    }
}
