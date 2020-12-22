<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    // id страницы
    const ABOUT_PAGE_ID = 1;
    
    protected $table = 'about_page';
    
    protected $fillable = array(
        'site_id', 'title_text', 'title_img', 'after_title_text', 'after_title_img', 'team_title_text', 'after_team_text', 'after_team_img',
    );
}
