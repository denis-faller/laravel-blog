<?php

namespace Blog\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Searchable;

    protected $fillable = array();
    
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
