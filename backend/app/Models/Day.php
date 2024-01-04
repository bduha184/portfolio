<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Day extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'team_id'
    ];

    public function days():BelongsTo{
        return $this->belongsTo(Day::class);
    }

    public function scopeSearch($query,$keywords){
        foreach ($keywords as $keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        return $query;
    }
}
