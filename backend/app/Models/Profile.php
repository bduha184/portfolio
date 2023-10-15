<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    use HasFactory;

    protected $fillable=[
        'header_img_path',
        'thumbnail_path',
        'introduction',
        'request_flg',
    ];

    public function teams():BelongsToMany{
        return $this->belongsToMany(Team::class)->withTimestamps();
    }

}
