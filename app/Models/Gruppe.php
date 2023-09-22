<?php

namespace App\Models;

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
        return $this->hasMany('App\Models\Baustein');
    }

    public function dokuments(){
        return $this->belongsToMany('App\Models\Dokument');
    }
}
