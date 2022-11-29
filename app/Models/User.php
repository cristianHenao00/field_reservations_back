<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'created_at',
        'updated_at'
    ];

    //Relación 1 a 1
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    //Relación 1 a n
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    //Relación n a n
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'users_team');
    }

    //Relación n a n
    public function ratings()
    {
        return $this->belongsToMany(Rating::class, 'users_rating');
    }


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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
