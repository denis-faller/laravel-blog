<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    // id страницы
    const ABOUT_PAGE_ID = 1;
    
    protected $table = 'about_page';
    
    protected $fillable = array();
}
