<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderMenu extends Model
{
    const ITEM_MENU_MAIN = 1;
    
    protected $table = 'header_menu';
    
    protected $fillable = [
        'site_id', 'name', 'url', 'sort',
    ];
}
