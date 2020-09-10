<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = array('post_id', 'parent_id', 'name', 'email', 'website', 'message');
    
    /**
    * Автор комментария
    */
    public function author()
    {
      return $this->belongsTo('Blog\Models\User', 'author_id');
    }
}
