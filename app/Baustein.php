<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baustein extends Model
{
    protected $fillable = [
        'name',
        'nummer',
        'html',
        'marker'
    ];

    public function dokumentations(){
        return $this->belongsToMany('App\Dokumentation');
    }
}
