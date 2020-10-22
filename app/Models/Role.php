<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_ADMIN = 1;
    const ROLE_REGISTERED_USER = 2;
    const ROLE_CONTENT_MANAGER = 3;
    
    protected $fillable = [];
}
