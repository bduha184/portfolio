<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
    public function users(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function getUserInfoById($auth_id)
    {
        return

            // $this->where('receiver_id', '=', $auth_id)
            // ->whereNotExists('created_at',function($query){
            //     $query->select(DB::raw('MAX(created_at)'))
            //     ->from('messages')
            //     ->groupBy('sender_id');
            // })
            // ->get();

        // ->select([
        // ])
        // ->from('messages')
        // ->join('profiles', 'messages.sender_id', '=', 'profiles.user_id')
        // ->where('messages.sender_id', function ($query) {
        //     $query->select(DB::raw('MAX(created_at)'))->from('messages')->groupBy('sender_id');
        // })
        // ->get();
        $this
        ->where('receiver_id', '=', $auth_id)
        ->select([
            'messages.sender_id',
            'messages.comments',
            'profiles.thumbnail_path',
            'profiles.title',
        ])
        ->from('messages')
        ->join('profiles', 'messages.sender_id', '=', 'profiles.user_id')
        // ->where('messages.id', function ($query) {
        //     $query->select(DB::raw('MAX(id) As id'))->from('messages')->groupBy('sender_id');
        // })
        ->get();

        // return
        // $this
        // ->where('receiver_id','=',$auth_id)
        // ->whereIn('id',function($query){
        //  $query->select(DB::raw('MAX(id) As id'))->from('messages')->groupBy('sender_id');
        // })
        // ->get();
        // return
        // $this
        // ->where('receiver_id','=',$auth_id)
        // ->where('sender_id','!=',$auth_id)
        // ->join('users','messages.sender_id','=','users.id')
        // ->join('profiles','messages.sender_id','=','profiles.user_id')
        // ->get();
    }


    public function getSnsMessageById($sender_id, $auth_id)
    {
        return
            $this
            ->where(function($query)  use($sender_id,$auth_id){
                $query->where('sender_id',$sender_id)
                ->orWhere('sender_id',$auth_id);

                $query->where('receiver_id',$auth_id)
                ->orWhere('receiver_id',$sender_id);
            })
            ->join('profiles', 'messages.sender_id', '=', 'profiles.user_id')
            ->orderBy('messages.created_at', 'asc')
            ->get();
    }
}
