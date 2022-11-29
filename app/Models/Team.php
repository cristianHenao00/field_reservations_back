<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'number_players',
        'public',
        'limit',
        'created_at',
        'updated_at'
    ];

    //Relación n a n
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_team');
    }

    //Relación n a n
    public function fields()
    {
        return $this->belongsToMany(Field::class, 'reservations');
    }
}
