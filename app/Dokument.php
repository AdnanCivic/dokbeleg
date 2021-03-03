<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokument extends Model
{
    protected $fillable = [
        'name', 
        'user_id', 
        'anzahlGruppen'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function gruppes(){
        return $this->belongsToMany('App\Gruppe');
    }

    public function bausteins(){
        return $this->hasManyThrough('App\Baustein', 'App\Gruppe');
    }

}
