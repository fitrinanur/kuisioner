<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionIndicator extends Model
{
    protected $fillable = [
        'indicator'
    ]; 

    public function question(){
        return $this->hasMany('App\Question','question_indicators_id');
    }
}
