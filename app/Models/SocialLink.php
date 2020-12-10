<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    const FACEBOOK_LINK_ID = 1;
    
    protected $fillable = array(
         'site_id', 'name', 'href', 'sort',
    );
}
