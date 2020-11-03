<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    const TAG_TRAVEL_ID = 1;
    
    protected $fillable = [
        'site_id', 'name', 'url', 'color',
    ];
}
