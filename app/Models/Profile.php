<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'phone_number',
        'url_facebook',
        'created_at',
        'updated_at',
        'url_avatar'
    ];

    //Indicar que le pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
