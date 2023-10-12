<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;


    protected $fillable = [
        'team_name',
        'request_flg'
    ];

    public function users():BelongsToMany{
        return $this->belongsToMany(User::class);
    }

}
