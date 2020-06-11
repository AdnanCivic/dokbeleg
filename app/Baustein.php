<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baustein extends Model
{
    protected $fillable = [
        'name',
        'html'
    ];

    public function dokumentations(){
        return $this->belongsToMany('App\Dokumentation');
    }
}
