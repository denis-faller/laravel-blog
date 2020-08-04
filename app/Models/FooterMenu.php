<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class FooterMenu extends Model
{
    protected $table = 'footer_menu';
    
    protected $fillable = array('name', 'url', 'sort');
}
