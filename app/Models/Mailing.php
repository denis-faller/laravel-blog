<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Mailing extends Model
{
    const MAILING_AI_REMOVES_ID = 1;
    
    protected $fillable = array('site_id', 'post_id', 'send_time');
    
    /**
    * Пост рассылки 
    */
    public function post()
    {
      return $this->belongsTo('Blog\Models\Post', 'post_id');
    }
}
