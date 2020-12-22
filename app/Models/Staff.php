<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    const EMPLOYEE_KATE_HAMPTON = 1;
    
    protected $fillable = array(
        'about_page_id', 'name', 'description', 'img', 'facebook', 'instagram', 'twitter',
    );
}
