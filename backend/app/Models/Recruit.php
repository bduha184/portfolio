<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recruit extends Model
{
    use HasFactory;


    protected $fillable = [
        'header_img_path',
        'thumbnail_path',
        'title',
        'text',
        'activities',
    ];

    public function users():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
