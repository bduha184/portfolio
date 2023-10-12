<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Recruit extends Model
{
    use HasFactory;


    protected $fillable = [
        'header_img_path',
        'thumbnail_path',
        'team_name',
        'introduction',
        'activities',
    ];

    public function users():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function teams():HasOne{
        return $this->hasOne(Team::class);
    }
}
