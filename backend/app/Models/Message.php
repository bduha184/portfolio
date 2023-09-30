<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'comments',
        'receiver_id',
        'sender_id',
    ];
    public function users():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function getUserInfoById($auth_id){
        return DB::table('messages')
        ->where('receiver_id','=',$auth_id)
        ->where('sender_id','!=',$auth_id)
        ->join('users','messages.sender_id','=','users.id')
        ->join('profiles','messages.sender_id','=','profiles.user_id')
        ->get();
    }

    public function getSnsMessageById($sender_id,$receiver_id){
        return DB::table('messages')
        ->Where('sender_id','=',$sender_id)
        ->orWhere('receiver_id','=',$sender_id)
        ->join('profiles','messages.sender_id','=','profiles.user_id')
        ->orderBy('messages.created_at','asc')
        ->get();
    }

}
