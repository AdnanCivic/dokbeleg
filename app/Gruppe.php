<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gruppe extends Model
{
    protected $fillable = [
        'user_id',
        'dokument_id',
        'dokument_pos',
        'name', 
        'anzahlBausteine'
    ];

    public function bausteins(){
        return $this->hasMany('App\Baustein');
    }

    public function dokuments(){
        return $this->belongsToMany('App\Dokument');
    }
}
