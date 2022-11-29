<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersTeam extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'team_id',
        'created_at',
        'updated_at',
    ];
}
