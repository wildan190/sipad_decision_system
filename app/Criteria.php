<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    //
    protected $guarded = [];
    protected $with = ['sub_criteria'];
    public function sub_criteria()
    {
        return $this->hasMany('App\SubCriteria');
    }
    public function assessment()
    {
        return $this->hasMany('App\Assessment');
        //return $this->hasMany('App\Assessment_AHP');
    }

    public function ahp(){

        return $this->hasMany('App\Assessment_AHP');

    }

    public function saw(){

        return $this->hasMany('App\Assessment_SAW');

    }
}
