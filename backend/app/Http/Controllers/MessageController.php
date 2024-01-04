<?php

namespace App\Http\Controllers;

use App\Events\SnsMessages;
use App\Models\Message;
use App\Models\User;
use App\Models\Team;
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
        $sender = User::find($sender_id);
        if(!empty($sender)){
            $messages = $message->getSnsMessageById($sender_id,$auth_id);
        }

        // $team = Team::find($auth_id);
        // $is_belongs_to = $team->profiles()->find($sender_id);
        // if(!empty($team) && !empty($is_belongs_to)){
        //     $messages = $message->getSnsMessageByTeamId($team->id);
        // }
        return response()->json([
            // 'team'=>$team,
            // 'is_belongs_to'=>$is_belongs_to,
            'messages'=>$messages,
        ]);
    }

    public function get_team_messages(Message $message,$team_id)
    {

        $team = Team::find($team_id);
        if(!empty($team)){
            $messages = $message->getSnsMessageByTeamId($team->id);
        }
        return response()->json([
            'team'=>$team,
            'messages'=>$messages,
        ]);
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

}
