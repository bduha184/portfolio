<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //

    public function show($name) {
        $tag = Tag::where('name',$name)->first();
        $articles = $tag->articles->all();

        $articles_with_user = [];

        foreach($articles as $article){
            $article_with_user = Article::where('id',$article->id)->with('user')->with('tags')->get();
            array_push($articles_with_user,$article_with_user);
        }
        return $articles_with_user;
    }
}
