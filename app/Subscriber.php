<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    //
    protected $fillable = [
        'name','age','profession','education','gender','diseaseHistory','telephoneNumber','address','isVaccine','informedConsent'
    ];

}
