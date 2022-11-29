<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    protected $fillable = [
        'field_type',
        'field_characteristic',
        'field_location',
        'created_at',
        'updated_at'
    ];

    //Relación n a n
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'reservations');
    }

    //Relación 1 a n
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
