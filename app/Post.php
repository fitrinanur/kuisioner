<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //fillable 
    protected $fillable = [
        'title','description','link','status'
    ];
}
