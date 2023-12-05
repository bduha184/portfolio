<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    use HasFactory;

    protected $fillable=[
        'header_img_path',
        'thumbnail_path',
        'introduction',
        'request_flg',
    ];

    public function teams():HasMany{
        return $this->hasMany(Team::class);
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function messages():HasMany{
        return $this->hasMany(Message::class);
    }

}
