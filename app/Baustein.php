<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baustein extends Model
{
    public function dokumentations(){
        return $this->belongsToMany('App\Dokumentation');
    }
}
