<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersRating extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'rating_id',
        'created_at',
        'updated_at',
    ];
}
