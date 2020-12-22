<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class FooterMenu extends Model
{
    const ITEM_MENU_MAIN = 1;
 
    protected $table = 'footer_menu';
    
    protected $fillable = [
        'site_id', 'name', 'url', 'sort',
    ];
}
