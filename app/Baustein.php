<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baustein extends Model
{
    protected $fillable = [
        'user_id',
        'gruppe_id',
        'gruppe_pos',
        'name',
        'typ',
        'heading',
        'content',
        'marker'
    ];

    public function gruppe(){
        return $this->belongsTo('App\Gruppe');
    }
}
