<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_REGISTERED_USER = 2;
    
    protected $fillable = [];
    
    /**
    * Пользователи роли
    */
    public function users()
    {
      return $this->belongsToMany('Blog\Models\User');
    }
}
