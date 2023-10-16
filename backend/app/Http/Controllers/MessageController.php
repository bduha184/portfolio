<?php

namespace App\Http\Controllers;

use App\Events\SnsMessages;
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

    public function index(Message $message)
    {
        $auth_id = Auth::id();
        $messages = $message->getUserInfoById($auth_id);

        return response()->json([
            'messages'=>$messages,
        ]);
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

        $user = Auth::user();
        $message->fill($request->all())->save();

        SnsMessages::dispatch($user, $message);

        return response()->json([
            'message'=>$message,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message,$sender_id)
    {

        $auth_id = Auth::id();
        $messages = $message->getSnsMessageById($sender_id,$auth_id);

        return response()->json([
            'data'=>$messages,
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
    public function update(Request $request, Message $message,$id)
    {
        $message = $message->where('sender_id',$id)->first();
        $message->fill($request->all())->save();


        return response()->json([
            'message'=>$message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
