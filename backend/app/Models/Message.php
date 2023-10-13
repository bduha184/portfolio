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
        'sender_id',
    ];

    public function getUserInfoById($auth_id)
    {
        return
        $this
        ->where('receiver_id', $auth_id)
        ->whereIn('messages.id', function ($query) {
            $query->select(DB::raw('MAX(id)'))
                ->from('messages')
                ->groupBy('sender_id');
        })
        ->select([
            'messages.sender_id',
            'messages.comments',
            'profiles.request_flg',
            'profiles.thumbnail_path',
            'users.name',
        ])
        ->from('messages')
        ->join('profiles', 'messages.sender_id', '=', 'profiles.user_id')
        ->join('users', 'messages.sender_id', '=', 'users.id')
        ->get();
    }


    public function getSnsMessageById($sender_id, $auth_id)
    {
        return
            $this
            ->where(function ($query)  use ($sender_id, $auth_id) {
                $query->where('sender_id', $sender_id)
                    ->orWhere('sender_id', $auth_id);

                $query->where('receiver_id', $auth_id)
                    ->orWhere('receiver_id', $sender_id);
            })
            ->join('profiles', 'messages.sender_id', '=', 'profiles.user_id')
            ->join('users', 'messages.sender_id', '=', 'users.id')
            ->orderBy('messages.created_at', 'asc')
            ->get();
    }
}
