<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const CATEGORY_POLITIC_ID = 1;
    
    protected $table = 'categories';
    
    protected $fillable = [
        'site_id', 'name', 'url', 'description',
    ];
}
