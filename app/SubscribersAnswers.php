<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subscriber;

class SubscribersAnswers extends Model
{
    protected $fillable = [
        'id','subscribers_id','pre_score_indicator','pre_answer','pre_score','post_score_indicator','post_answer','post_score'
    ];

    public function subscribers(){
        return $this->belongsTo(Subscriber::class,'subscribers_id','id');
    }
}
