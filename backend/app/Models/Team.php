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
        'average',
        'from_age',
        'to_age',
        'detailActivities',
        'detailAreas',
        'activeDateTime',
        'teamUrl',
        'schedule',
    ];

    public function profiles():BelongsToMany{
        return $this->belongsToMany(Profile::class)->withTimestamps();
    }
    public function tags():BelongsToMany{
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    public function areas():BelongsToMany{
        return $this->belongsToMany(Area::class)->withTimestamps();
    }

}
