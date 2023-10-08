<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Mail\BareMail;
use App\Notifications\ResetPassword;

// use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'member_flg',
        'request_flg',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function recruits():HasOne{
        return $this->hasOne(Recruit::class);
    }

    public function images():HasMany{
        return $this->hasMany(Recruit::class);
    }

    public function messages():HasMany{
        return $this->hasMany(Message::class);
    }

    public function likes():BelongsToMany{
        return $this->belongsToMany(Article::class,'likes')->withTimestamps();
    }

    public function followers():BelongsToMany{
        return $this->belongsToMany(User::class,'follows','followee_id','follower_id')->withTimestamps();
    }

    public function followees():BelongsToMany{
        return $this->belongsToMany(User::class,'follows','follower_id','followee_id')->withTimestamps();
    }

    public function provider():HasMany{
        return $this->hasMany(Provider::class);
    }

}
