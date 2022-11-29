<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'field_id',
        'rating',
        'comment',
        'created_at',
        'updated_at',
    ];

    //Relación 1 a n
    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    //Relación n a n
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_rating');
    }
}
