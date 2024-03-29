<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_roles';
    use HasFactory;
    protected $fillable = [
        'role_id',
        'permission_id',
        'created_at',
        'updated_at'
    ];
}
