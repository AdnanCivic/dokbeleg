<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokument extends Model
{
    protected $fillable = [
        'name', 
        'user_id', 
        'anzahlGruppen'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function gruppes(){
        return $this->belongsToMany('App\Models\Gruppe');
    }

}
