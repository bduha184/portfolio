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
        'introduction',
        'activities',
    ];

    public function profiles():BelongsToMany{
        return $this->belongsToMany(Profile::class)->withTimestamps();
    }

}
