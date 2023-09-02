<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;


class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'comments',
        'receiver_id',
        'sender_id'
    ];
    public function users():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function getUserInfoById(){
        return DB::table('messages')
        ->join('users','messages.sender_id','=','users.id')
        ->join('profiles','messages.sender_id','=','profiles.user_id')
        ->get();
    }

}
