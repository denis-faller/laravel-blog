<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const LOREM_IPSUM_COMMENT_ID = 1;
    
    protected $fillable = array('author_id', 'post_id', 'parent_id', 'name', 'email', 'website', 'message');
    
    /**
    * Автор комментария
    */
    public function author()
    {
      return $this->belongsTo('Blog\Models\User', 'author_id');
    }
}
