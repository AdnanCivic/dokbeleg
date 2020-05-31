<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baustein extends Model
{
    protected $dateFormat = 'dd.mm.YYYY';

    public function dokumentations(){
        return $this->belongsToMany('App\Dokumentation');
    }
}
