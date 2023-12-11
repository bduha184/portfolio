<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_img_path',
        'thumbnail_path',
        'team_name',
        'introduction',
        'average',
        'from_age',
        'to_age',
        'detail_activity',
        'detail_area',
        'daytime',
        'team_url',
        'schedule',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function rides(): HasMany
    {
        return $this->hasMany(Ride::class);
    }
    public function areas(): HasMany
    {
        return $this->hasMany(Area::class);
    }
    public function days(): HasMany
    {
        return $this->hasMany(Day::class);
    }
}
