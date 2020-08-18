<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    // id страницы
    const CONTACT_PAGE_ID = 1;
    
    protected $table = 'contact_page';
    
    protected $fillable = array();
}
