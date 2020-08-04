<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderMenu extends Model
{
    protected $table = 'header_menu';
    
    protected $fillable = array('name', 'url', 'sort');
}
