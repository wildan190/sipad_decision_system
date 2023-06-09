<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $guarded = [];
    protected $fillable = [
        'media_name', 'size', 'ukuran', 'address', 'position'
    ];
    
    public function assessment()
    {
        return $this->hasMany('App\Assessment');
    }

    public function ahp(){
        return $this->hasMany('App\Assessment_AHP');
    }

    public function saw(){
        return $this->hasMany('App\Assessment_SAW');
    }
}
