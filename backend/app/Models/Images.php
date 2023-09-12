<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Images extends Model
{
    use HasFactory;

    protected $fillable=[
        'image_path'
    ];


    public function users():BelongsTo{
        return $this->BelongsTo(User::class);
    }
}
