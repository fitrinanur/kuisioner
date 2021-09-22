<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class IconSymbol extends Model
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
                'source' => 'title'
            ]
        ];
    }

    //
    //fillable 
    protected $fillable = [
        'photo','title'
    ];


    public function suggestion(){
        return $this->hasMany('App\Suggestion','icon_id');
    }


    public function optionSuggestion(){
        return $this->hasMany('App\OptionSuggestion','icon_id');
    }

}
