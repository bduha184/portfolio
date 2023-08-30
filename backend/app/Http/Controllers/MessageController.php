<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        // return response()->json([
        //     'messages'=>$messages,
        // ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Message $message)
    {

        $message->fill($request->all());
        $message->user_id=Auth::id();
        $message->save();

        return response()->json([

            'message'=>Response::HTTP_OK

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $messages = Message::where('parent_id',$id)->latest()->get();


        $messages->each(function($message){
            // $message->
        });
        // collect($request->tags)->each(function ($tagName) use ($article) {
        //     $tag = Tag::updateOrCreate(['name' => $tagName]);
        //     $article->tags()->attach($tag);
        // });

        $sender_id = Message::where('parent_id',$id)->first()->user_id;
        $sender_name = User::find($sender_id)->name;
        $thumbnail = Profile::where('user_id',$sender_id)->first()->thumbnail_path;

        return response()->json([
            'messages'=>$messages,
            'sender_name'=>$sender_name,
            'thumbnail'=>$thumbnail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
