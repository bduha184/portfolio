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
        'comment',
        'receiver_id',
        'sender_id',
        'team_id',
    ];

    public function profiles(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function teams(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }



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
                'messages.comment',
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
            ->where('team_id',null)
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

    public function getSnsMessageByTeamId($team_id)
    {
        return
            $this
            ->where('team_id', $team_id)
            ->where('receiver_id',null)
            ->join('profiles', 'messages.sender_id', '=', 'profiles.user_id')
            ->orderBy('messages.created_at', 'asc')
            ->get();
    }
}
