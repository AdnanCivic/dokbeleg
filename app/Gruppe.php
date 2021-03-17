<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gruppe extends Model
{
    protected $fillable = [
        'user_id',
        'name', 
        'anzahlBausteine',
        'hasDeckblatt'
    ];

    public function bausteins(){
        return $this->hasMany('App\Baustein');
    }

    public function dokuments(){
        return $this->belongsToMany('App\Dokument');
    }
}
