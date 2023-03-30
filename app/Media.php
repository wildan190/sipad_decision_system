<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $guarded = [];
    public function assessment()
    {
        return $this->hasMany('App\Assessment');
    }
}
