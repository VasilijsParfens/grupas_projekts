<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isFollowing($userId)
    {
        return Follower::where('user_id', $userId)
            ->where('follower_id', $this->id) // Šeit mēs izmantojam pašreizējā lietotāja ID
            ->exists();
    }

    // Relationships
    public function following()
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'user_id');
    }

}
