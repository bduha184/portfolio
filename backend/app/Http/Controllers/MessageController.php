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
    public function index(Message $message,$dist)
    {
        $auth_id = Auth::id();
        $results = $message->getUserInfoById($auth_id,$dist);

        return response()->json([
            'messages'=>$results,
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

        $message->fill($request->all())->save();

        return response()->json([
            'message'=>Response::HTTP_OK
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message,$id)
    {

        $auth_id = Auth::id();
        $results = $message->getSnsMessageById($id,$auth_id);

        return response()->json([
            'data'=>$results,
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
