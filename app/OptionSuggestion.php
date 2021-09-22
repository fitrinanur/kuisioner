<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionSuggestion extends Model
{
    //fillable 

 

    protected $fillable = [
        'options_id','icon_id',
    ];

   
    public function icon(){
        return $this->belongsTo('App\IconSymbol','icon_id');
    }
}
