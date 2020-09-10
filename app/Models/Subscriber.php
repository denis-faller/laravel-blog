<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = array('site_id', 'email');
}
