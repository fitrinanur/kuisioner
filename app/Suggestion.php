<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    //fillable 
    protected $fillable = [
        'icon_id','title','sug_desc','external_url','active'
    ];


    public function icon(){
        return $this->belongsTo('App\IconSymbol','icon_id');
    }



}
