<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    //fillable 
    protected $fillable = [
        'main_title','sort_desc','light_logo', 'dark_logo', 'theme_style','favicon','site_title','footer_text'
    ];
    
}
