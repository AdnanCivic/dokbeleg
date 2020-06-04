<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumentation extends Model
{
    protected $fillable = [
        'name', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function bausteins(){
        return $this->belongsToMany('App\Baustein');
    }

    public function baustein(){

    }
}
