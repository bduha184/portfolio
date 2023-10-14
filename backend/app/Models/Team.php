<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;


    protected $fillable = [
        'header_img_path',
        'thumbnail_path',
        'team_name',
        'introduction',
        'activities',
    ];

    public function users():BelongsToMany{
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
