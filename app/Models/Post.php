<?php

namespace Blog\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //use Searchable;
    
    const AI_REMOVES_POST_ID = 1;

    protected $fillable = [
        'site_id', 'main_page', 'name', 'url', 'publish_time', 'preview_img', 'img', 'view_count', 'category_id', 'author_id', 'text',
    ];
    
    /**
    * Теги поста
    */
    public function tags()
    {
      return $this->belongsToMany('Blog\Models\Tag');
    }
    
    /**
    * Категория поста
    */
    public function categories()
    {
      return $this->belongsTo('Blog\Models\Category', 'category_id');
    }
    
    /**
    * Автор поста
    */
    public function author()
    {
      return $this->belongsTo('Blog\Models\User', 'author_id');
    }
}
