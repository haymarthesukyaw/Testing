<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name','email','password', 'profile', 'type', 'phone', 'address', 'dob',
        'create_user_id', 'updated_user_id', 'deleted_user_id',
        'deleted_at', 'remember_token',
    ];
}
