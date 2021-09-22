<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Question extends Model
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'question'
            ]
        ];
    }

    //fillable 
    protected $fillable = [
        'question_indicators_id','question','photo','step'
    ];

    public function option(){
        return $this->hasMany('App\Option','questionId');
    }

    public function questionIndicator(){
        return $this->belongsTo('App\QuestionIndicator','question_indicators_id');
    }

}
