<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Area extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'team_id'
    ];

    public function teams():BelongsTo{
        return $this->belongsTo(Team::class);
    }
}
