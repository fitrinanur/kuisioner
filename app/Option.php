<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

    //fillable 
    protected $fillable = [
        'questionId','optionName','optionImg','isRadius','isCircle','active'
    ];


    public function question(){
        return $this->belongsTo('App\Question','questionId');
    }

}
