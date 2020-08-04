<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = array('name', 'url', 'color');
}
