<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    const RICH_SITE_MAIL_ID = 1;
    
    protected $fillable = array('site_id', 'email');
}
