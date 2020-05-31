<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumentation extends Model
{
    protected $dateFormat = 'dd.mm.YYYY';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function bausteins(){
        return $this->belongsToMany('App\Baustein');
    }

    public function baustein(){

    }
}
