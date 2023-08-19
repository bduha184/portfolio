<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Recruit extends Model
{
    use HasFactory;


    protected $fillable = [
        'header_img_path',
        'thumbnail_path',
        'title',
        'text',
    ];

    public function users():HasOne{
        return $this->hasOne(User::class);
    }
}
