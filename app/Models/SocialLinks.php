<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLinks extends Model
{
    protected $table = 'social_links';
    
    protected $fillable = array('name', 'href', 'sort');
}
